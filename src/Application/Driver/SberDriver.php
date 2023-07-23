<?php

declare(strict_types=1);

namespace App\Application\Driver;

class SberDriver implements DriverInterface
{

    private $envIronment = '';

    public function pay(array $param): array
    {
        // @TODO work is here https://snipp.ru/php/sberbank-pay

        return $param;
    }

    public function setEnvIronment(string $envIronment): void
    {
        $this->envIronment = $envIronment;
    }

    private function getPayUrl()
    {
        if ($this->envIronment === 'prod') {
            return 'https://securepayments.sberbank.ru/payment/rest/register.do';
        } else {
            return 'https://3dsec.sberbank.ru/payment/rest/register.do';
        }
    }
}