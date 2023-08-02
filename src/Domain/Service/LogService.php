<?php

namespace App\Domain\Service;

use App\Domain\Entity\Log;
use Doctrine\ORM\EntityManagerInterface;

class LogService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly Log $log
    )
    {
    }

    function writeLog(array $param): void
    {
        $this->log->setName($param['name']);
        $this->log->setDate(new \DateTime());
        $this->log->setEmail($param['email']);
        $this->log->setOrder($param['cart']);
        $this->log->setPhone($param['phone']);

        $this->entityManager->persist($this->log);
        $this->entityManager->flush();
    }
}