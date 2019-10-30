<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191027072442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD school_year_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D2EECC3F FOREIGN KEY (school_year_id) REFERENCES school_year (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D2EECC3F ON user (school_year_id)');
        $this->addSql('ALTER TABLE school_year DROP FOREIGN KEY FK_FAAAACDAA76ED395');
        $this->addSql('DROP INDEX IDX_FAAAACDAA76ED395 ON school_year');
        $this->addSql('ALTER TABLE school_year DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE school_year ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE school_year ADD CONSTRAINT FK_FAAAACDAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FAAAACDAA76ED395 ON school_year (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D2EECC3F');
        $this->addSql('DROP INDEX IDX_8D93D649D2EECC3F ON user');
        $this->addSql('ALTER TABLE user DROP school_year_id');
    }
}
