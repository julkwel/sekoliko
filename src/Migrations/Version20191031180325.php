<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191031180325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE class_subject (id INT AUTO_INCREMENT NOT NULL, class_room_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, coefficient VARCHAR(10) DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_3EBB59869162176F (class_room_id), UNIQUE INDEX UNIQ_3EBB598623EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE class_subject ADD CONSTRAINT FK_3EBB59869162176F FOREIGN KEY (class_room_id) REFERENCES class_room (id)');
        $this->addSql('ALTER TABLE class_subject ADD CONSTRAINT FK_3EBB598623EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE class_subject');
    }
}
