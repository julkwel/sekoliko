<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190328230553 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_bibliotheque (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, book_name VARCHAR(200) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, INDEX IDX_10A8F090A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_bibliotheque ADD CONSTRAINT FK_10A8F090A76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sk_bibliotheque');
    }
}
