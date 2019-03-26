<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190326223059 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_matiere DROP FOREIGN KEY FK_A1BC20CA6FC3B45D');
        $this->addSql('ALTER TABLE sk_niveau DROP FOREIGN KEY FK_8D269CC53741BC70');
        $this->addSql('ALTER TABLE sk_salle DROP FOREIGN KEY FK_BB2162663741BC70');
        $this->addSql('DROP TABLE ets');
        $this->addSql('ALTER TABLE sk_abs ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_classe ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_edt ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_etudiant ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_A1BC20CA6FC3B45D ON sk_matiere');
        $this->addSql('ALTER TABLE sk_matiere ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL, DROP actEvent');
        $this->addSql('DROP INDEX IDX_8D269CC53741BC70 ON sk_niveau');
        $this->addSql('ALTER TABLE sk_niveau ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL, DROP etsNom');
        $this->addSql('ALTER TABLE sk_note ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_profs ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_retard ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_BB2162663741BC70 ON sk_salle');
        $this->addSql('ALTER TABLE sk_salle ADD deb_reserve DATETIME DEFAULT NULL, ADD fin_reserve DATETIME DEFAULT NULL, ADD motifs VARCHAR(200) DEFAULT NULL, ADD ets_nom VARCHAR(100) NOT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) NOT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL, DROP etsNom');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ets (id INT AUTO_INCREMENT NOT NULL, ets_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, ets_adresse LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, ets_responsable VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, ets_phone VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, ets_email VARCHAR(150) DEFAULT NULL COLLATE utf8_unicode_ci, ets_logo VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_abs DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_classe DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_edt DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_etudiant DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_matiere ADD actEvent INT DEFAULT NULL, DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_matiere ADD CONSTRAINT FK_A1BC20CA6FC3B45D FOREIGN KEY (actEvent) REFERENCES ets (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A1BC20CA6FC3B45D ON sk_matiere (actEvent)');
        $this->addSql('ALTER TABLE sk_niveau ADD etsNom INT DEFAULT NULL, DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_niveau ADD CONSTRAINT FK_8D269CC53741BC70 FOREIGN KEY (etsNom) REFERENCES ets (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8D269CC53741BC70 ON sk_niveau (etsNom)');
        $this->addSql('ALTER TABLE sk_note DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_profs DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_retard DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_salle ADD etsNom INT DEFAULT NULL, DROP deb_reserve, DROP fin_reserve, DROP motifs, DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_salle ADD CONSTRAINT FK_BB2162663741BC70 FOREIGN KEY (etsNom) REFERENCES ets (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_BB2162663741BC70 ON sk_salle (etsNom)');
    }
}
