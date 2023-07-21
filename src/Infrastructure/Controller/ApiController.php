<?php

namespace App\Infrastructure\Controller;

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
        PayTransformer $payTransformer
    )
    {
        $payData = $payTransformer->transformObject(
            $request->request->all()
        );

        return $this->json($payData);
    }
}