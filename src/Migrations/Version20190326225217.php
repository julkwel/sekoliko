<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190326225217 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_user CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_abs CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_classe CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_edt CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_etudiant CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_matiere CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_niveau CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_note CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_profs CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_retard CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_salle CHANGE ets_nom ets_nom VARCHAR(100) DEFAULT NULL, CHANGE ets_responsable ets_responsable VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_abs CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_classe CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_edt CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_etudiant CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_matiere CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_niveau CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_note CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_profs CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_retard CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_salle CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_user CHANGE ets_nom ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE ets_responsable ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
    }
}
