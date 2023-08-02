<?php

namespace App\Domain\Transform;

use App\Domain\DTO\PayDTO;

class PayTransformer
{
    public function transformObject($payData): PayDTO
    {
        $dto = new PayDTO();

        $dto->email = ($payData['email'] ?? false);
        $dto->name = ($payData['name'] ?? false);
        $dto->phone = ($payData['phone'] ?? false);
        $dto->orderNumber = (int)($payData['orderNumber'] ?? false);
        $dto->userName = (string)($payData['userName'] ?? false);
        $dto->password = (string)($payData['password'] ?? false);
        $dto->failUrl = (string)($payData['failUrl'] ?? false);
        $dto->returnUrl = (string)($payData['returnUrl'] ?? false);
        $dto->cart = (string)($payData['cart'] ?? false);
        $dto->description = mb_substr(
            (string)(
                $payData['description'] ?? ''
            ),
            0,
            24
        );
        $dto->clientId = (string)($payData['clientId'] ?? false);
        return $dto;
    }
}