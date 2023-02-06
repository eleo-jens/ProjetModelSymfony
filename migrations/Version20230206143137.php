<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206143137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt ADD exemplaire_emprunte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D720EDBCFB FOREIGN KEY (exemplaire_emprunte_id) REFERENCES exemplaire (id)');
        $this->addSql('CREATE INDEX IDX_364071D720EDBCFB ON emprunt (exemplaire_emprunte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D720EDBCFB');
        $this->addSql('DROP INDEX IDX_364071D720EDBCFB ON emprunt');
        $this->addSql('ALTER TABLE emprunt DROP exemplaire_emprunte_id');
    }
}
