<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220729090023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE research_output ADD work_package_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE research_output ADD CONSTRAINT FK_6B3FB49DEF2F062C FOREIGN KEY (work_package_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B3FB49DEF2F062C ON research_output (work_package_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE research_output DROP CONSTRAINT FK_6B3FB49DEF2F062C');
        $this->addSql('DROP INDEX IDX_6B3FB49DEF2F062C');
        $this->addSql('ALTER TABLE research_output DROP work_package_id');
    }
}
