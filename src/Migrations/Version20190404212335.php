<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190404212335 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_paiement (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(150) NOT NULL, date DATETIME NOT NULL, montant VARCHAR(45) NOT NULL, commentaire LONGTEXT DEFAULT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sk_paiement_user (sk_paiement_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8A9D0AAEA1ABBA4D (sk_paiement_id), INDEX IDX_8A9D0AAEA76ED395 (user_id), PRIMARY KEY(sk_paiement_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_paiement_user ADD CONSTRAINT FK_8A9D0AAEA1ABBA4D FOREIGN KEY (sk_paiement_id) REFERENCES sk_paiement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_paiement_user ADD CONSTRAINT FK_8A9D0AAEA76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_paiement_user DROP FOREIGN KEY FK_8A9D0AAEA1ABBA4D');
        $this->addSql('DROP TABLE sk_paiement');
        $this->addSql('DROP TABLE sk_paiement_user');
    }
}
