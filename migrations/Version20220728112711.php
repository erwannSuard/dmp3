<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728112711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE research_output ADD romp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE research_output ADD CONSTRAINT FK_6B3FB49D8CA4ACB1 FOREIGN KEY (romp_id) REFERENCES romp (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B3FB49D8CA4ACB1 ON research_output (romp_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE research_output DROP CONSTRAINT FK_6B3FB49D8CA4ACB1');
        $this->addSql('DROP INDEX IDX_6B3FB49D8CA4ACB1');
        $this->addSql('ALTER TABLE research_output DROP romp_id');
    }
}
