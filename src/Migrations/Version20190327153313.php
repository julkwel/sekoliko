<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190327153313 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_note ADD etudiant INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_note ADD CONSTRAINT FK_76659743717E22E3 FOREIGN KEY (etudiant) REFERENCES sk_etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_note ADD CONSTRAINT FK_76659743EEC51E56 FOREIGN KEY (matNom) REFERENCES sk_matiere (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_76659743717E22E3 ON sk_note (etudiant)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_note DROP FOREIGN KEY FK_76659743717E22E3');
        $this->addSql('ALTER TABLE sk_note DROP FOREIGN KEY FK_76659743EEC51E56');
        $this->addSql('DROP INDEX IDX_76659743717E22E3 ON sk_note');
        $this->addSql('ALTER TABLE sk_note DROP etudiant');
    }
}
