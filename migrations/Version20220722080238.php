<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220722080238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cost ALTER type SET NOT NULL');
        $this->addSql('ALTER TABLE distribution ALTER access SET NOT NULL');
        $this->addSql('ALTER TABLE distribution ALTER size_unit SET NOT NULL');
        $this->addSql('ALTER TABLE research_output ALTER type SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cost ALTER type DROP NOT NULL');
        $this->addSql('ALTER TABLE research_output ALTER type DROP NOT NULL');
        $this->addSql('ALTER TABLE distribution ALTER access DROP NOT NULL');
        $this->addSql('ALTER TABLE distribution ALTER size_unit DROP NOT NULL');
    }
}
