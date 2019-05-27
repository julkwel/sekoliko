<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190527132706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE classe_matiere ADD as_name VARCHAR(100) NOT NULL, ADD as_date_debut DATETIME NOT NULL, ADD as_date_fin DATETIME DEFAULT NULL, ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_addresse VARCHAR(100) NOT NULL, ADD ets_contact VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE professeur ADD as_name VARCHAR(100) NOT NULL, ADD as_date_debut DATETIME NOT NULL, ADD as_date_fin DATETIME DEFAULT NULL, ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_addresse VARCHAR(100) NOT NULL, ADD ets_contact VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere ADD as_name VARCHAR(100) NOT NULL, ADD as_date_debut DATETIME NOT NULL, ADD as_date_fin DATETIME DEFAULT NULL, ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_addresse VARCHAR(100) NOT NULL, ADD ets_contact VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE niveau ADD as_name VARCHAR(100) NOT NULL, ADD as_date_debut DATETIME NOT NULL, ADD as_date_fin DATETIME DEFAULT NULL, ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_addresse VARCHAR(100) NOT NULL, ADD ets_contact VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD as_name VARCHAR(100) NOT NULL, ADD as_date_debut DATETIME NOT NULL, ADD as_date_fin DATETIME DEFAULT NULL, ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_addresse VARCHAR(100) NOT NULL, ADD ets_contact VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel ADD as_name VARCHAR(100) NOT NULL, ADD as_date_debut DATETIME NOT NULL, ADD as_date_fin DATETIME DEFAULT NULL, ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_addresse VARCHAR(100) NOT NULL, ADD ets_contact VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE classe ADD as_name VARCHAR(100) NOT NULL, ADD as_date_debut DATETIME NOT NULL, ADD as_date_fin DATETIME DEFAULT NULL, ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_addresse VARCHAR(100) NOT NULL, ADD ets_contact VARCHAR(60) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE classe DROP as_name, DROP as_date_debut, DROP as_date_fin, DROP ets_nom, DROP ets_addresse, DROP ets_contact');
        $this->addSql('ALTER TABLE classe_matiere DROP as_name, DROP as_date_debut, DROP as_date_fin, DROP ets_nom, DROP ets_addresse, DROP ets_contact');
        $this->addSql('ALTER TABLE etudiant DROP as_name, DROP as_date_debut, DROP as_date_fin, DROP ets_nom, DROP ets_addresse, DROP ets_contact');
        $this->addSql('ALTER TABLE matiere DROP as_name, DROP as_date_debut, DROP as_date_fin, DROP ets_nom, DROP ets_addresse, DROP ets_contact');
        $this->addSql('ALTER TABLE niveau DROP as_name, DROP as_date_debut, DROP as_date_fin, DROP ets_nom, DROP ets_addresse, DROP ets_contact');
        $this->addSql('ALTER TABLE personnel DROP as_name, DROP as_date_debut, DROP as_date_fin, DROP ets_nom, DROP ets_addresse, DROP ets_contact');
        $this->addSql('ALTER TABLE professeur DROP as_name, DROP as_date_debut, DROP as_date_fin, DROP ets_nom, DROP ets_addresse, DROP ets_contact');
    }
}
