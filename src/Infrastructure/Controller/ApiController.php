<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Domain\Repository\PaymentTypeRepository;
use App\Domain\Repository\UserRepository;
use App\Domain\Transform\PayTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function getApi(): JsonResponse
    {
        return $this->json(['Welcome!']);
    }

    #[Route('/api/pay', name: 'app_api_pay')]
    public function pay(
        Request $request,
        PayTransformer $payTransformer,
        UserRepository $userRepository,
        PaymentTypeRepository $paymentTypeRepository
    ): JsonResponse|RedirectResponse
    {
        $userData = $userRepository->getUserPaymentData((int)$this->getUser()?->getId());

        $payData = $payTransformer->transformObject(
            array_merge(
                $request->request->all(),
                $userData
            )
        );

        $driver = $paymentTypeRepository->find($userData['driver']);
        $driver = 'App\Application\Driver\\' . $driver->getDriver();

        $driverAction = new $driver();
        $driverAction->setEnvironment($this->getParameter('kernel.environment'));
        $out = $driverAction->pay($payData);

        if (!empty($out['formUrl'])) {
            return $this->redirect($out['formUrl']);
        } else {
            return $this->json($out);
        }
    }
}