<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191027191936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, start DATETIME DEFAULT NULL, end DATETIME DEFAULT NULL, description VARCHAR(150) DEFAULT NULL, is_valid TINYINT(1) DEFAULT NULL, INDEX IDX_42C8495554177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495554177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE room DROP reservation_start, DROP reservation_end, DROP reservation_description, DROP reservation_is_valid');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE reservation');
        $this->addSql('ALTER TABLE room ADD reservation_start DATETIME DEFAULT NULL, ADD reservation_end DATETIME DEFAULT NULL, ADD reservation_description VARCHAR(150) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD reservation_is_valid TINYINT(1) DEFAULT NULL');
    }
}
