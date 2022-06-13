<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613100506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE funding_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE romp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, last_name TEXT NOT NULL, first_name TEXT DEFAULT NULL, mail TEXT NOT NULL, affiliation TEXT NOT NULL, laboratory_or_department TEXT DEFAULT NULL, identifier TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contact_project (id INT NOT NULL, contact_id INT NOT NULL, project_id INT NOT NULL, role_contact TEXT CHECK (role_contact IN (\'Coordinator\', \'WP_Leader\', \'WP_Participant\', \'DMP_Leader\')), PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B59CF16FE7A1254A ON contact_project (contact_id)');
        $this->addSql('CREATE INDEX IDX_B59CF16F166D1F9C ON contact_project (project_id)');
        $this->addSql('CREATE TABLE funding (id INT NOT NULL, funder_id INT NOT NULL, grant_funding BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D30DD1D66CC88588 ON funding (funder_id)');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, funding_id INT DEFAULT NULL, parent_project_id INT DEFAULT NULL, title TEXT NOT NULL, abstract TEXT NOT NULL, acronym TEXT DEFAULT NULL, start_date DATE NOT NULL, duration INT DEFAULT NULL, website TEXT DEFAULT NULL, objectives TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE9D70482 ON project (funding_id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE512E9BCC ON project (parent_project_id)');
        $this->addSql('CREATE TABLE romp (id INT NOT NULL, project_id INT NOT NULL, contact_id INT NOT NULL, identifier TEXT DEFAULT NULL, submission_date DATE NOT NULL, version_romp TEXT NOT NULL, deliverable TEXT NOT NULL, licence_romp TEXT CHECK (licence_romp IN (\'CC-BY-4.0\', \'CC-BY-NC-4.0\', \'CC-BY--ND-4.0\', \'CC-BY--SA-4.0\', \'CC0-1.0\')), ethical_issues TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23AF5FC0166D1F9C ON romp (project_id)');
        $this->addSql('CREATE INDEX IDX_23AF5FC0E7A1254A ON romp (contact_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE contact_project ADD CONSTRAINT FK_B59CF16FE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contact_project ADD CONSTRAINT FK_B59CF16F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE funding ADD CONSTRAINT FK_D30DD1D66CC88588 FOREIGN KEY (funder_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE9D70482 FOREIGN KEY (funding_id) REFERENCES funding (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE512E9BCC FOREIGN KEY (parent_project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE romp ADD CONSTRAINT FK_23AF5FC0166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE romp ADD CONSTRAINT FK_23AF5FC0E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contact_project DROP CONSTRAINT FK_B59CF16FE7A1254A');
        $this->addSql('ALTER TABLE funding DROP CONSTRAINT FK_D30DD1D66CC88588');
        $this->addSql('ALTER TABLE romp DROP CONSTRAINT FK_23AF5FC0E7A1254A');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE9D70482');
        $this->addSql('ALTER TABLE contact_project DROP CONSTRAINT FK_B59CF16F166D1F9C');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE512E9BCC');
        $this->addSql('ALTER TABLE romp DROP CONSTRAINT FK_23AF5FC0166D1F9C');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE funding_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE romp_id_seq CASCADE');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contact_project');
        $this->addSql('DROP TABLE funding');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE romp');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
