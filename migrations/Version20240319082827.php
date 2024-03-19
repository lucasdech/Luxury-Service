<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319082827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidats (id INT AUTO_INCREMENT NOT NULL, id_experience_id INT DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, adress VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, is_pass_port TINYINT(1) DEFAULT NULL, pass_port_files VARCHAR(255) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, profil_picture VARCHAR(255) DEFAULT NULL, current_location VARCHAR(255) NOT NULL, date_of_birth VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, pass_word VARCHAR(255) NOT NULL, aviability DATE DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, date_created DATETIME DEFAULT NULL, date_updated DATETIME DEFAULT NULL, date_delete DATETIME DEFAULT NULL, file VARCHAR(255) DEFAULT NULL, INDEX IDX_3C663B15F8C1DF42 (id_experience_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, society_name VARCHAR(255) NOT NULL, activitie_type VARCHAR(255) DEFAULT NULL, contact_name VARCHAR(255) NOT NULL, poste VARCHAR(255) DEFAULT NULL, contact_number VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, notes VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, id_category_id INT DEFAULT NULL, id_job_type_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, job_title VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, closing_date DATE DEFAULT NULL, salary INT NOT NULL, created_date DATE DEFAULT NULL, INDEX IDX_288A3A4EA545015 (id_category_id), INDEX IDX_288A3A4E47B1F6FF (id_job_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_to_candidat (id INT AUTO_INCREMENT NOT NULL, id_job_offer_id INT NOT NULL, id_candidat_id INT NOT NULL, time DATETIME DEFAULT NULL, is_approved TINYINT(1) DEFAULT NULL, INDEX IDX_C48031961740A4E7 (id_job_offer_id), INDEX IDX_C480319610C22675 (id_candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15F8C1DF42 FOREIGN KEY (id_experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EA545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E47B1F6FF FOREIGN KEY (id_job_type_id) REFERENCES job_type (id)');
        $this->addSql('ALTER TABLE job_to_candidat ADD CONSTRAINT FK_C48031961740A4E7 FOREIGN KEY (id_job_offer_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE job_to_candidat ADD CONSTRAINT FK_C480319610C22675 FOREIGN KEY (id_candidat_id) REFERENCES candidats (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15F8C1DF42');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EA545015');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E47B1F6FF');
        $this->addSql('ALTER TABLE job_to_candidat DROP FOREIGN KEY FK_C48031961740A4E7');
        $this->addSql('ALTER TABLE job_to_candidat DROP FOREIGN KEY FK_C480319610C22675');
        $this->addSql('DROP TABLE candidats');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_to_candidat');
        $this->addSql('DROP TABLE job_type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
