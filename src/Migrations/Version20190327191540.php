<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190327191540 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_discipline (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, descritpion LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_discipline_list (id INT AUTO_INCREMENT NOT NULL, discipline_id INT NOT NULL, name VARCHAR(80) NOT NULL, INDEX IDX_824EA63CA5522701 (discipline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_discipline_list ADD CONSTRAINT FK_824EA63CA5522701 FOREIGN KEY (discipline_id) REFERENCES sk_discipline (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_discipline_list DROP FOREIGN KEY FK_824EA63CA5522701');
        $this->addSql('DROP TABLE sk_discipline');
        $this->addSql('DROP TABLE sk_discipline_list');
    }
}
