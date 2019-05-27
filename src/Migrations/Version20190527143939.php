<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190527143939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trimestre ADD date_debut DATE DEFAULT NULL, ADD date_fin DATE DEFAULT NULL, CHANGE as_date_debut as_date_debut DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE classe_matiere CHANGE as_date_debut as_date_debut DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE professeur CHANGE as_date_debut as_date_debut DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere CHANGE as_date_debut as_date_debut DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE niveau CHANGE as_date_debut as_date_debut DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD as_name VARCHAR(100) NOT NULL, ADD as_date_debut DATETIME DEFAULT NULL, ADD as_date_fin DATETIME DEFAULT NULL, ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_addresse VARCHAR(100) NOT NULL, ADD ets_contact VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant CHANGE as_date_debut as_date_debut DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel CHANGE as_date_debut as_date_debut DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE classe CHANGE as_date_debut as_date_debut DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE classe CHANGE as_date_debut as_date_debut DATETIME NOT NULL');
        $this->addSql('ALTER TABLE classe_matiere CHANGE as_date_debut as_date_debut DATETIME NOT NULL');
        $this->addSql('ALTER TABLE etudiant CHANGE as_date_debut as_date_debut DATETIME NOT NULL');
        $this->addSql('ALTER TABLE fos_user DROP as_name, DROP as_date_debut, DROP as_date_fin, DROP ets_nom, DROP ets_addresse, DROP ets_contact');
        $this->addSql('ALTER TABLE matiere CHANGE as_date_debut as_date_debut DATETIME NOT NULL');
        $this->addSql('ALTER TABLE niveau CHANGE as_date_debut as_date_debut DATETIME NOT NULL');
        $this->addSql('ALTER TABLE personnel CHANGE as_date_debut as_date_debut DATETIME NOT NULL');
        $this->addSql('ALTER TABLE professeur CHANGE as_date_debut as_date_debut DATETIME NOT NULL');
        $this->addSql('ALTER TABLE trimestre DROP date_debut, DROP date_fin, CHANGE as_date_debut as_date_debut DATETIME NOT NULL');
    }
}
