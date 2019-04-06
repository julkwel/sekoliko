<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190405214035 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_retard ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_paiement ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_classe ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_etudiant ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_note ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_edt ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_salle ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_bibliotheque CHANGE debut debut DATETIME DEFAULT NULL, CHANGE fin fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_matiere ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_information ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_book ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_guide ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_theme ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_discipline_list ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_discipline ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_niveau ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_profs ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_bibliotheque CHANGE debut debut DATETIME NOT NULL, CHANGE fin fin DATETIME NOT NULL');
        $this->addSql('ALTER TABLE sk_book DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_classe DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_discipline DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_discipline_list DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_edt DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_etudiant DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_guide DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_information DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_matiere DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_niveau DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_note DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_paiement DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_profs DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_retard DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_salle DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_theme DROP debut, DROP fin');
    }
}
