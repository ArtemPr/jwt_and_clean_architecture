<?php

declare(strict_types=1);

namespace App\Application\Driver;

interface DriverInterface
{
    public function pay(array $param): array;

    public function setEnvIronment(string $param): void;
}