<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191027063130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE scolarite (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, user_id INT DEFAULT NULL, salaires VARCHAR(100) DEFAULT NULL, date_create DATETIME DEFAULT NULL, adresse VARCHAR(50) NOT NULL, contact VARCHAR(50) DEFAULT NULL, INDEX IDX_276250ABC54C8C93 (type_id), UNIQUE INDEX UNIQ_276250ABA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scolarite ADD CONSTRAINT FK_276250ABC54C8C93 FOREIGN KEY (type_id) REFERENCES scolarite_type (id)');
        $this->addSql('ALTER TABLE scolarite ADD CONSTRAINT FK_276250ABA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE scolarite');
    }
}
