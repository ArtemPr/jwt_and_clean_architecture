<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230723102105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD success_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD fail_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD bank_login VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD bank_password VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP name');
        $this->addSql('ALTER TABLE "user" DROP success_url');
        $this->addSql('ALTER TABLE "user" DROP fail_url');
        $this->addSql('ALTER TABLE "user" DROP bank_login');
        $this->addSql('ALTER TABLE "user" DROP bank_password');
    }
}
