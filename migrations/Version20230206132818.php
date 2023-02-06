<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206132818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hobby (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hobby_eleve (hobby_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_EF8C4AB8322B2123 (hobby_id), INDEX IDX_EF8C4AB8A6CC7B2 (eleve_id), PRIMARY KEY(hobby_id, eleve_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hobby_eleve ADD CONSTRAINT FK_EF8C4AB8322B2123 FOREIGN KEY (hobby_id) REFERENCES hobby (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hobby_eleve ADD CONSTRAINT FK_EF8C4AB8A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hobby_eleve DROP FOREIGN KEY FK_EF8C4AB8322B2123');
        $this->addSql('ALTER TABLE hobby_eleve DROP FOREIGN KEY FK_EF8C4AB8A6CC7B2');
        $this->addSql('DROP TABLE hobby');
        $this->addSql('DROP TABLE hobby_eleve');
    }
}
