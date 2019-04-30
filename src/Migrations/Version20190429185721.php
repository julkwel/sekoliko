<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429185721 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_user ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_bibliotheque ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_book ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_classe ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_conge ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_discipline ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_discipline_list ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_edt ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_etudiant ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_guide ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_information ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_matiere ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_niveau ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_note ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_paiement ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_profs ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_retard ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_salle ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_theme ADD as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_trimestre ADD as_name VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_bibliotheque DROP as_name');
        $this->addSql('ALTER TABLE sk_book DROP as_name');
        $this->addSql('ALTER TABLE sk_classe DROP as_name');
        $this->addSql('ALTER TABLE sk_conge DROP as_name');
        $this->addSql('ALTER TABLE sk_discipline DROP as_name');
        $this->addSql('ALTER TABLE sk_discipline_list DROP as_name');
        $this->addSql('ALTER TABLE sk_edt DROP as_name');
        $this->addSql('ALTER TABLE sk_etudiant DROP as_name');
        $this->addSql('ALTER TABLE sk_guide DROP as_name');
        $this->addSql('ALTER TABLE sk_information DROP as_name');
        $this->addSql('ALTER TABLE sk_matiere DROP as_name');
        $this->addSql('ALTER TABLE sk_niveau DROP as_name');
        $this->addSql('ALTER TABLE sk_note DROP as_name');
        $this->addSql('ALTER TABLE sk_paiement DROP as_name');
        $this->addSql('ALTER TABLE sk_profs DROP as_name');
        $this->addSql('ALTER TABLE sk_retard DROP as_name');
        $this->addSql('ALTER TABLE sk_salle DROP as_name');
        $this->addSql('ALTER TABLE sk_theme DROP as_name');
        $this->addSql('ALTER TABLE sk_trimestre DROP as_name');
        $this->addSql('ALTER TABLE sk_user DROP as_name');
    }
}
