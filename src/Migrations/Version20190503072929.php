<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503072929 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_7D7CAB339014574A ON sk_classe_matiere');
        $this->addSql('ALTER TABLE sk_classe_matiere ADD matiere_id INT DEFAULT NULL, DROP matiere');
        $this->addSql('ALTER TABLE sk_classe_matiere ADD CONSTRAINT FK_7D7CAB33F46CD258 FOREIGN KEY (matiere_id) REFERENCES sk_matiere (id)');
        $this->addSql('CREATE INDEX IDX_7D7CAB33F46CD258 ON sk_classe_matiere (matiere_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_classe_matiere DROP FOREIGN KEY FK_7D7CAB33F46CD258');
        $this->addSql('DROP INDEX IDX_7D7CAB33F46CD258 ON sk_classe_matiere');
        $this->addSql('ALTER TABLE sk_classe_matiere ADD matiere VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP matiere_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D7CAB339014574A ON sk_classe_matiere (matiere)');
    }
}
