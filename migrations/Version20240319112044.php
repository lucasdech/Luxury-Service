<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319112044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidats ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B159D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3C663B159D86650F ON candidats (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B159D86650F');
        $this->addSql('DROP INDEX UNIQ_3C663B159D86650F ON candidats');
        $this->addSql('ALTER TABLE candidats DROP user_id_id');
    }
}
