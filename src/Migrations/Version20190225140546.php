<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190225140546 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_etudiant (id INT AUTO_INCREMENT NOT NULL, niveau INT DEFAULT NULL, etudiant INT DEFAULT NULL, note INT DEFAULT NULL, UNIQUE INDEX UNIQ_9CF709B44BDFF36B (niveau), UNIQUE INDEX UNIQ_9CF709B4717E22E3 (etudiant), INDEX IDX_9CF709B4CFBDFA14 (note), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_profs (id INT AUTO_INCREMENT NOT NULL, profs INT DEFAULT NULL, matiere INT DEFAULT NULL, UNIQUE INDEX UNIQ_B250034547E61F7F (profs), INDEX IDX_B25003459014574A (matiere), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_etudiant ADD CONSTRAINT FK_9CF709B44BDFF36B FOREIGN KEY (niveau) REFERENCES sk_classe (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE sk_etudiant ADD CONSTRAINT FK_9CF709B4717E22E3 FOREIGN KEY (etudiant) REFERENCES sk_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_etudiant ADD CONSTRAINT FK_9CF709B4CFBDFA14 FOREIGN KEY (note) REFERENCES sk_note (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE sk_profs ADD CONSTRAINT FK_B250034547E61F7F FOREIGN KEY (profs) REFERENCES sk_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_profs ADD CONSTRAINT FK_B25003459014574A FOREIGN KEY (matiere) REFERENCES sk_matiere (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sk_etudiant');
        $this->addSql('DROP TABLE sk_profs');
    }
}
