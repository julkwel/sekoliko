<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190327154526 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_etudiant DROP FOREIGN KEY FK_9CF709B4CFBDFA14');
        $this->addSql('DROP INDEX IDX_9CF709B4CFBDFA14 ON sk_etudiant');
        $this->addSql('ALTER TABLE sk_etudiant DROP note');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_etudiant ADD note INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_etudiant ADD CONSTRAINT FK_9CF709B4CFBDFA14 FOREIGN KEY (note) REFERENCES sk_note (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_9CF709B4CFBDFA14 ON sk_etudiant (note)');
    }
}
