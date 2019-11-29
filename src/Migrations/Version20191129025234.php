<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191129025234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE class_subject ADD profs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE class_subject ADD CONSTRAINT FK_3EBB5986BDDFA3C9 FOREIGN KEY (profs_id) REFERENCES scolarite (id)');
        $this->addSql('CREATE INDEX IDX_3EBB5986BDDFA3C9 ON class_subject (profs_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE class_subject DROP FOREIGN KEY FK_3EBB5986BDDFA3C9');
        $this->addSql('DROP INDEX IDX_3EBB5986BDDFA3C9 ON class_subject');
        $this->addSql('ALTER TABLE class_subject DROP profs_id');
    }
}
