<?php

namespace App\Domain\DTO;

use JMS\Serializer\Annotation as Serializer;

class PayDTO
{
    #[Serializer\Type("string")]
    public ?string $orderNumber;

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

    #[Serializer\Type("string")]
    public ?string $userName;

    #[Serializer\Type("string")]
    public ?string $password;

    #[Serializer\Type("string")]
    public ?string $returnUrl;

    #[Serializer\Type("string")]
    public ?string $failUrl;

    #[Serializer\Type("string")]
    public ?string $description;

    #[Serializer\Type("string")]
    public ?string $cart;
}