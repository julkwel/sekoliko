<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429183827 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_conge (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_deb DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, motif LONGTEXT DEFAULT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, anne_scolaire_debut DATETIME DEFAULT NULL, anne_scolaire_fin DATETIME DEFAULT NULL, INDEX IDX_DB6E8F72A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_conge ADD CONSTRAINT FK_DB6E8F72A76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id)');
        $this->addSql('DROP TABLE sk_cong');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_cong (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_deb DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, motif LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, ets_nom VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ets_adresse LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, ets_responsable VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ets_phone VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ets_email VARCHAR(150) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ets_logo VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, anne_scolaire_debut DATETIME DEFAULT NULL, anne_scolaire_fin DATETIME DEFAULT NULL, INDEX IDX_DA2CD469A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sk_cong ADD CONSTRAINT FK_DA2CD469A76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id)');
        $this->addSql('DROP TABLE sk_conge');
    }
}
