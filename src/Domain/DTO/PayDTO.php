<?php

namespace App\Domain\DTO;

use JMS\Serializer\Annotation as Serializer;

class PayDTO
{
    #[Serializer\Type("string")]
    public ?string $orderId;

    #[Serializer\Type("float")]
    public ?float $sum;

    #[Serializer\Type("string")]
    public ?string $name;

    #[Serializer\Type("string")]
    public ?string $phone;

    #[Serializer\Type("string")]
    public ?string $email;

    #[Serializer\Type("string")]
    public ?string $product;
}