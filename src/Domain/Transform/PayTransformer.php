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
        $dto->sum = (float)($payData['sum'] ?? false);
        $dto->product = (string)($payData['product'] ?? false);
        $dto->orderId = (int)($payData['orderId'] ?? false);

        return $dto;
    }
}