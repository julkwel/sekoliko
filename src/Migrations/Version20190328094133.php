<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190328094133 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_edt ADD edtClasse INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_edt ADD CONSTRAINT FK_591D95298592913F FOREIGN KEY (edtClasse) REFERENCES sk_classe (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_591D95298592913F ON sk_edt (edtClasse)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_edt DROP FOREIGN KEY FK_591D95298592913F');
        $this->addSql('DROP INDEX IDX_591D95298592913F ON sk_edt');
        $this->addSql('ALTER TABLE sk_edt DROP edtClasse');
    }
}
