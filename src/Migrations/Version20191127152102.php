<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127152102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE section_school_year');
        $this->addSql('ALTER TABLE class_room DROP FOREIGN KEY FK_C6E266D4D2EECC3F');
        $this->addSql('DROP INDEX IDX_C6E266D4D2EECC3F ON class_room');
        $this->addSql('ALTER TABLE class_room DROP school_year_id');
        $this->addSql('ALTER TABLE student CHANGE contact_parent contact_parent VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE section_school_year (section_id INT NOT NULL, school_year_id INT NOT NULL, INDEX IDX_EC5BD3A5D823E37A (section_id), INDEX IDX_EC5BD3A5D2EECC3F (school_year_id), PRIMARY KEY(section_id, school_year_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE section_school_year ADD CONSTRAINT FK_EC5BD3A5D2EECC3F FOREIGN KEY (school_year_id) REFERENCES school_year (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE section_school_year ADD CONSTRAINT FK_EC5BD3A5D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE class_room ADD school_year_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE class_room ADD CONSTRAINT FK_C6E266D4D2EECC3F FOREIGN KEY (school_year_id) REFERENCES school_year (id)');
        $this->addSql('CREATE INDEX IDX_C6E266D4D2EECC3F ON class_room (school_year_id)');
        $this->addSql('ALTER TABLE student CHANGE contact_parent contact_parent VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
