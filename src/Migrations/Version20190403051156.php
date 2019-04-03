<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190403051156 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_bug (id INT AUTO_INCREMENT NOT NULL, user INT DEFAULT NULL, titre VARCHAR(200) NOT NULL, color VARCHAR(200) DEFAULT NULL, description LONGTEXT NOT NULL, date_ajout DATETIME NOT NULL, status LONGTEXT NOT NULL, attachment LONGTEXT DEFAULT NULL, INDEX IDX_8B35E1628D93D649 (user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_information (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(200) NOT NULL, description LONGTEXT NOT NULL, date_ajout DATETIME NOT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_classe_sk_matiere (sk_classe_id INT NOT NULL, sk_matiere_id INT NOT NULL, INDEX IDX_1FC34237ABCE875 (sk_classe_id), INDEX IDX_1FC3423AD2A0D02 (sk_matiere_id), PRIMARY KEY(sk_classe_id, sk_matiere_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_guide (id INT AUTO_INCREMENT NOT NULL, desciption VARCHAR(200) NOT NULL, attachment LONGTEXT DEFAULT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_bug ADD CONSTRAINT FK_8B35E1628D93D649 FOREIGN KEY (user) REFERENCES sk_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_classe_sk_matiere ADD CONSTRAINT FK_1FC34237ABCE875 FOREIGN KEY (sk_classe_id) REFERENCES sk_classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_classe_sk_matiere ADD CONSTRAINT FK_1FC3423AD2A0D02 FOREIGN KEY (sk_matiere_id) REFERENCES sk_matiere (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX email_canonical_UNIQUE ON sk_user');
        $this->addSql('ALTER TABLE sk_user CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE email_canonical email_canonical VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sk_bug');
        $this->addSql('DROP TABLE sk_information');
        $this->addSql('DROP TABLE sk_classe_sk_matiere');
        $this->addSql('DROP TABLE sk_guide');
        $this->addSql('ALTER TABLE sk_user CHANGE email email VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci, CHANGE email_canonical email_canonical VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX email_canonical_UNIQUE ON sk_user (email_canonical)');
    }
}
