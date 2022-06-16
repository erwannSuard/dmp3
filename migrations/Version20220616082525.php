<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616082525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE contact ADD user_auth_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638D88F9F96 FOREIGN KEY (user_auth_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638D88F9F96 ON contact (user_auth_id)');
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
        $this->addSql('ALTER TABLE contact DROP CONSTRAINT FK_4C62E638D88F9F96');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP INDEX UNIQ_4C62E638D88F9F96');
        $this->addSql('ALTER TABLE contact DROP user_auth_id');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact TYPE TEXT');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact DROP DEFAULT');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact DROP NOT NULL');
        $this->addSql('ALTER TABLE contact_project ALTER role_contact TYPE TEXT');
        $this->addSql('ALTER TABLE romp ALTER licence_romp DROP DEFAULT');
        $this->addSql('ALTER TABLE romp ALTER licence_romp DROP NOT NULL');
    }
}
