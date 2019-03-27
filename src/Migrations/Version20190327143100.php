<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190327143100 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_matiere ADD matClasse INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_matiere ADD CONSTRAINT FK_A1BC20CA76AA3D43 FOREIGN KEY (matClasse) REFERENCES sk_classe (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A1BC20CA76AA3D43 ON sk_matiere (matClasse)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_matiere DROP FOREIGN KEY FK_A1BC20CA76AA3D43');
        $this->addSql('DROP INDEX IDX_A1BC20CA76AA3D43 ON sk_matiere');
        $this->addSql('ALTER TABLE sk_matiere DROP matClasse');
    }
}
