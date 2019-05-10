<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190509171525 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_bug_comment (id INT AUTO_INCREMENT NOT NULL, comment_id INT DEFAULT NULL, user_id INT DEFAULT NULL, comment LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_45A4AEE9F8697D13 (comment_id), INDEX IDX_45A4AEE9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_classe_matiere (id INT AUTO_INCREMENT NOT NULL, matiere_id INT DEFAULT NULL, mat_coeff VARCHAR(100) DEFAULT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, as_name VARCHAR(100) DEFAULT NULL, anne_scolaire_debut DATETIME DEFAULT NULL, anne_scolaire_fin DATETIME DEFAULT NULL, matProf INT DEFAULT NULL, matClasse INT DEFAULT NULL, INDEX IDX_7D7CAB33F46CD258 (matiere_id), INDEX IDX_7D7CAB33623B6832 (matProf), INDEX IDX_7D7CAB3376AA3D43 (matClasse), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_conge (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_deb DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, motif LONGTEXT DEFAULT NULL, type LONGTEXT NOT NULL, is_fin TINYINT(1) DEFAULT \'0\' NOT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, as_name VARCHAR(100) DEFAULT NULL, anne_scolaire_debut DATETIME DEFAULT NULL, anne_scolaire_fin DATETIME DEFAULT NULL, INDEX IDX_DB6E8F72A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_info_comment (id INT AUTO_INCREMENT NOT NULL, comment_id INT DEFAULT NULL, user_id INT DEFAULT NULL, comment LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_4089582FF8697D13 (comment_id), INDEX IDX_4089582FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_paiement (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(150) NOT NULL, date DATETIME NOT NULL, montant VARCHAR(45) NOT NULL, commentaire LONGTEXT DEFAULT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, as_name VARCHAR(100) DEFAULT NULL, anne_scolaire_debut DATETIME DEFAULT NULL, anne_scolaire_fin DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_paiement_user (sk_paiement_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8A9D0AAEA1ABBA4D (sk_paiement_id), INDEX IDX_8A9D0AAEA76ED395 (user_id), PRIMARY KEY(sk_paiement_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_trimestre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, trim_debut DATETIME NOT NULL, trim_fin DATETIME NOT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, as_name VARCHAR(100) DEFAULT NULL, anne_scolaire_debut DATETIME DEFAULT NULL, anne_scolaire_fin DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_bug_comment ADD CONSTRAINT FK_45A4AEE9F8697D13 FOREIGN KEY (comment_id) REFERENCES sk_bug (id)');
        $this->addSql('ALTER TABLE sk_bug_comment ADD CONSTRAINT FK_45A4AEE9A76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id)');
        $this->addSql('ALTER TABLE sk_classe_matiere ADD CONSTRAINT FK_7D7CAB33F46CD258 FOREIGN KEY (matiere_id) REFERENCES sk_matiere (id)');
        $this->addSql('ALTER TABLE sk_classe_matiere ADD CONSTRAINT FK_7D7CAB33623B6832 FOREIGN KEY (matProf) REFERENCES sk_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_classe_matiere ADD CONSTRAINT FK_7D7CAB3376AA3D43 FOREIGN KEY (matClasse) REFERENCES sk_classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_conge ADD CONSTRAINT FK_DB6E8F72A76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id)');
        $this->addSql('ALTER TABLE sk_info_comment ADD CONSTRAINT FK_4089582FF8697D13 FOREIGN KEY (comment_id) REFERENCES sk_information (id)');
        $this->addSql('ALTER TABLE sk_info_comment ADD CONSTRAINT FK_4089582FA76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id)');
        $this->addSql('ALTER TABLE sk_paiement_user ADD CONSTRAINT FK_8A9D0AAEA1ABBA4D FOREIGN KEY (sk_paiement_id) REFERENCES sk_paiement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_paiement_user ADD CONSTRAINT FK_8A9D0AAEA76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_user ADD is_conge TINYINT(1) DEFAULT NULL, ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_abs ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_bibliotheque ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_book ADD author VARCHAR(200) DEFAULT NULL, ADD edition VARCHAR(200) DEFAULT NULL, ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_classe ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_discipline ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_discipline_list ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_edt ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_etudiant ADD is_renvoie TINYINT(1) DEFAULT \'0\', ADD date_renvoie DATETIME DEFAULT NULL, ADD motif_renvoie LONGTEXT DEFAULT NULL, ADD date_de_naissance VARCHAR(200) DEFAULT NULL, ADD mere VARCHAR(200) DEFAULT NULL, ADD pere VARCHAR(200) DEFAULT NULL, ADD contact_parent VARCHAR(100) DEFAULT NULL, ADD sexe VARCHAR(100) DEFAULT NULL, ADD addition VARCHAR(100) DEFAULT NULL, ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_guide ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_information ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_matiere DROP FOREIGN KEY FK_A1BC20CA623B6832');
        $this->addSql('ALTER TABLE sk_matiere DROP FOREIGN KEY FK_A1BC20CA76AA3D43');
        $this->addSql('DROP INDEX IDX_A1BC20CA76AA3D43 ON sk_matiere');
        $this->addSql('DROP INDEX IDX_A1BC20CA623B6832 ON sk_matiere');
        $this->addSql('ALTER TABLE sk_matiere ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL, DROP matProf, DROP matClasse, CHANGE mat_coeff as_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_niveau ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_note DROP FOREIGN KEY FK_76659743EEC51E56');
        $this->addSql('ALTER TABLE sk_note ADD trimestre INT DEFAULT NULL, ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_note ADD CONSTRAINT FK_766597435406BC48 FOREIGN KEY (trimestre) REFERENCES sk_trimestre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_note ADD CONSTRAINT FK_76659743EEC51E56 FOREIGN KEY (matNom) REFERENCES sk_classe_matiere (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_766597435406BC48 ON sk_note (trimestre)');
        $this->addSql('ALTER TABLE sk_profs ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_retard ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_salle ADD nombre_place INT DEFAULT NULL, ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_theme ADD as_name VARCHAR(100) DEFAULT NULL, ADD anne_scolaire_debut DATETIME DEFAULT NULL, ADD anne_scolaire_fin DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_note DROP FOREIGN KEY FK_76659743EEC51E56');
        $this->addSql('ALTER TABLE sk_paiement_user DROP FOREIGN KEY FK_8A9D0AAEA1ABBA4D');
        $this->addSql('ALTER TABLE sk_note DROP FOREIGN KEY FK_766597435406BC48');
        $this->addSql('DROP TABLE sk_bug_comment');
        $this->addSql('DROP TABLE sk_classe_matiere');
        $this->addSql('DROP TABLE sk_conge');
        $this->addSql('DROP TABLE sk_info_comment');
        $this->addSql('DROP TABLE sk_paiement');
        $this->addSql('DROP TABLE sk_paiement_user');
        $this->addSql('DROP TABLE sk_trimestre');
        $this->addSql('ALTER TABLE sk_abs DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_bibliotheque DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_book DROP author, DROP edition, DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_classe DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_discipline DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_discipline_list DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_edt DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_etudiant DROP is_renvoie, DROP date_renvoie, DROP motif_renvoie, DROP date_de_naissance, DROP mere, DROP pere, DROP contact_parent, DROP sexe, DROP addition, DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_guide DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_information DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_matiere ADD matProf INT DEFAULT NULL, ADD matClasse INT DEFAULT NULL, DROP anne_scolaire_debut, DROP anne_scolaire_fin, CHANGE as_name mat_coeff VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_matiere ADD CONSTRAINT FK_A1BC20CA623B6832 FOREIGN KEY (matProf) REFERENCES sk_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_matiere ADD CONSTRAINT FK_A1BC20CA76AA3D43 FOREIGN KEY (matClasse) REFERENCES sk_classe (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A1BC20CA76AA3D43 ON sk_matiere (matClasse)');
        $this->addSql('CREATE INDEX IDX_A1BC20CA623B6832 ON sk_matiere (matProf)');
        $this->addSql('ALTER TABLE sk_niveau DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_note DROP FOREIGN KEY FK_76659743EEC51E56');
        $this->addSql('DROP INDEX IDX_766597435406BC48 ON sk_note');
        $this->addSql('ALTER TABLE sk_note DROP trimestre, DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_note ADD CONSTRAINT FK_76659743EEC51E56 FOREIGN KEY (matNom) REFERENCES sk_matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_profs DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_retard DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_salle DROP nombre_place, DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_theme DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
        $this->addSql('ALTER TABLE sk_user DROP is_conge, DROP as_name, DROP anne_scolaire_debut, DROP anne_scolaire_fin');
    }
}
