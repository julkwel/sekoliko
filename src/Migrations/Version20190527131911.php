<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190527131911 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classe_matiere (id INT AUTO_INCREMENT NOT NULL, matieres_id INT NOT NULL, professeur_id INT DEFAULT NULL, classe_id INT NOT NULL, coefficient VARCHAR(50) DEFAULT NULL, obs LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_EB8D372B82350831 (matieres_id), UNIQUE INDEX UNIQ_EB8D372BBAB22EE9 (professeur_id), UNIQUE INDEX UNIQ_EB8D372B8F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, profs_id INT NOT NULL, cin VARCHAR(100) NOT NULL, date_cin DATETIME NOT NULL, heures_par_semaines VARCHAR(10) DEFAULT NULL, num_ae VARCHAR(100) DEFAULT NULL, date_prise_service VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_17A55299BDDFA3C9 (profs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, numero VARCHAR(10) DEFAULT NULL, nom_pere VARCHAR(100) DEFAULT NULL, nom_mere VARCHAR(100) DEFAULT NULL, prenom_pere VARCHAR(50) DEFAULT NULL, prenom_mere VARCHAR(50) DEFAULT NULL, contact_parent VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_717E22E38F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, cin VARCHAR(50) DEFAULT NULL, indice VARCHAR(50) DEFAULT NULL, grade VARCHAR(50) DEFAULT NULL, note_service VARCHAR(100) DEFAULT NULL, cisco VARCHAR(50) DEFAULT NULL, obs VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, nom VARCHAR(100) NOT NULL, INDEX IDX_8F87BF96B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe_matiere ADD CONSTRAINT FK_EB8D372B82350831 FOREIGN KEY (matieres_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE classe_matiere ADD CONSTRAINT FK_EB8D372BBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE classe_matiere ADD CONSTRAINT FK_EB8D372B8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299BDDFA3C9 FOREIGN KEY (profs_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE classe_matiere DROP FOREIGN KEY FK_EB8D372BBAB22EE9');
        $this->addSql('ALTER TABLE classe_matiere DROP FOREIGN KEY FK_EB8D372B82350831');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96B3E9C81');
        $this->addSql('ALTER TABLE classe_matiere DROP FOREIGN KEY FK_EB8D372B8F5EA509');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E38F5EA509');
        $this->addSql('DROP TABLE classe_matiere');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE classe');
    }
}
