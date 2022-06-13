<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613092501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_project ALTER role_contact TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact DROP DEFAULT');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact SET NOT NULL');
        $this->addSql('ALTER TABLE romp ALTER licence_romp SET DEFAULT \'CC-BY-4.0\'');
        $this->addSql('ALTER TABLE romp ALTER licence_romp SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact TYPE TEXT');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact DROP DEFAULT');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact DROP NOT NULL');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact TYPE TEXT');
        $this->addSql('ALTER TABLE romp ALTER licence_romp DROP DEFAULT');
        $this->addSql('ALTER TABLE romp ALTER licence_romp DROP NOT NULL');
    }
}
