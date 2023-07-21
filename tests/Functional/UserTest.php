<?php
namespace Tests\Functional;

use App\Domain\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByName(): void
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['username' => 'test'])
        ;
        $this->assertSame('test', $user->getUsername());
    }

    public function testMethod()
    {
        $this->assertTrue(
            method_exists(
                User::class,
                'getUsername'
            )
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }

}