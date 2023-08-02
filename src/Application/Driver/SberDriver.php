<?php

declare(strict_types=1);

namespace App\Application\Driver;

use App\Domain\DTO\PayDTO;
use Symfony\Component\HttpClient\HttpClient;

class SberDriver implements DriverInterface
{
    private HttpClient $httpClient;

    private int $orderSum = 0;

    private string|null $environment = null;

    public function __construct(
    )
    {
        $this->httpClient = HttpClient::create();
    }

    public function pay(PayDTO $param): array
    {
        $cart = $this->createCart(json_decode($param->cart, true));

        $payVars = [
            'userName' => $param->userName,
            'password' => $param->password,
            'orderNumber' => $param->orderNumber,
            'orderBundle' => json_encode(
                [
                    'cartItems' => [
                        'items' => $cart
                    ]
                ],
        JSON_UNESCAPED_UNICODE
            ),
            'amount' => $this->orderSum,
            'returnUrl' => $param->returnUrl,
            'failUrl' => $param->failUrl,
            'description' => $param->description
        ];

        return $this->send($payVars);
    }

    public function setEnvironment(string $param): void
    {
        $this->environment = $param;
    }

    private function createCart(array $param): array
    {
        $outArray = [];
        $orderSum = 0;
        $index = 1;
        foreach ($param as $value) {
            $outArray[] = [
                'positionId' => $index,
                'name' => $value['productName'],
                'quantity' => array(
                    'value' => $value['amount'],
                    'measure' => 'шт'
                ),
                'itemAmount' => $this->createAmount($value['amount'], $value['productPrice']),
                'itemCode' => $value['gid'],
                'itemPrice' => $this->createPrice($value['productPrice']),
            ];
            $index++;
            $this->orderSum += $this->createAmount($value['amount'], $value['productPrice']);
        }

        return $outArray;
    }

    private function createPrice(int $price): int
    {
        return $price * 100;
    }

    private function createAmount(int $count, int $price): int
    {
        return $count * $this->createPrice($price);
    }

    private function getPayUrl()
    {
        if ($this->envIronment === 'prod') {
            return 'https://securepayments.sberbank.ru/payment/rest/register.do';
        } else {
            return 'https://3dsec.sberbank.ru/payment/rest/register.do';
        }
    }

    private function send(array $param)
    {
        $response = $this->httpClient->request(
            'GET',
            $this->getPayUrl() . '?' . http_build_query($param),
            [
                'verify_host' => false,
                'verify_peer' => false
            ]
        );

        $statusCode = $response->getStatusCode();
        $content = $response->toArray();
        $content['status'] = $statusCode;

        return $content;
    }
}