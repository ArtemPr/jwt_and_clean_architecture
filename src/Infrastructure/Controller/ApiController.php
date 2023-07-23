<?php

namespace App\Infrastructure\Controller;

use App\Domain\Repository\PaymentTypeRepository;
use App\Domain\Repository\UserRepository;
use App\Domain\Transform\PayTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function getApi()
    {
        return $this->json(['api']);
    }

    #[Route('/api/pay', name: 'app_api_pay')]
    public function pay(
        Request $request,
        PayTransformer $payTransformer,
        UserRepository $userRepository,
        PaymentTypeRepository $paymentTypeRepository
    )
    {
        $payData = $payTransformer->transformObject(
            $request->request->all()
        );

        $userData = $userRepository->getUserPaymentData($this->getUser()->getId());
        $driver = $paymentTypeRepository->find($userData['driver']);
        $driver = 'App\Application\Driver\\' . $driver->getDriver();

        $driverAction = new $driver;
        $driverAction->setEnvIronment($this->getParameter('kernel.environment'));
        $out = $driverAction->pay($userData);

        return $this->json($out);
    }
}