<?php

declare(strict_types=1);

namespace App\Application\Driver;

use App\Domain\DTO\PayDTO;

interface DriverInterface
{
    public function pay(PayDTO $param): array;

    public function setEnvIronment(string $param): void;
}