<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190406051732 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_user ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_bibliotheque ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_book ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_classe ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_discipline ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_discipline_list ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_edt ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_etudiant ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_guide ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_information ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_matiere ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_niveau ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_note ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_paiement ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_profs ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_retard ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_salle ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
        $this->addSql('ALTER TABLE sk_theme ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP debut, DROP fin');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_bibliotheque ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_book ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_classe ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_discipline ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_discipline_list ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_edt ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_etudiant ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_guide ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_information ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_matiere ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_niveau ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_note ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_paiement ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_profs ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_retard ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_salle ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_theme ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_user ADD debut DATETIME DEFAULT NULL, ADD fin DATETIME DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
    }
}
