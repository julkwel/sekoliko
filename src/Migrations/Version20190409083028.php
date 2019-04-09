<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190409083028 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_note ADD trimestre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_note ADD CONSTRAINT FK_766597435406BC48 FOREIGN KEY (trimestre) REFERENCES sk_trimestre (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_766597435406BC48 ON sk_note (trimestre)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_note DROP FOREIGN KEY FK_766597435406BC48');
        $this->addSql('DROP INDEX IDX_766597435406BC48 ON sk_note');
        $this->addSql('ALTER TABLE sk_note DROP trimestre');
    }
}
