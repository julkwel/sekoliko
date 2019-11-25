<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191125161319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE room ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE class_subject ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE section ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE scolarite ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE school_year ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE administrator ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE scolarite_type ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE class_room ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE subject ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE administration_type ADD ets_logo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE administration_type DROP ets_logo');
        $this->addSql('ALTER TABLE administrator DROP ets_logo');
        $this->addSql('ALTER TABLE class_room DROP ets_logo');
        $this->addSql('ALTER TABLE class_subject DROP ets_logo');
        $this->addSql('ALTER TABLE room DROP ets_logo');
        $this->addSql('ALTER TABLE school_year DROP ets_logo');
        $this->addSql('ALTER TABLE scolarite DROP ets_logo');
        $this->addSql('ALTER TABLE scolarite_type DROP ets_logo');
        $this->addSql('ALTER TABLE section DROP ets_logo');
        $this->addSql('ALTER TABLE student DROP ets_logo');
        $this->addSql('ALTER TABLE subject DROP ets_logo');
        $this->addSql('ALTER TABLE user DROP ets_logo');
    }
}
