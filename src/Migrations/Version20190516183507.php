<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516183507 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sk_paiement_user');
        $this->addSql('ALTER TABLE sk_paiement ADD user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_paiement ADD CONSTRAINT FK_5C5551498D93D649 FOREIGN KEY (user) REFERENCES sk_user (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_5C5551498D93D649 ON sk_paiement (user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_paiement_user (sk_paiement_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8A9D0AAEA1ABBA4D (sk_paiement_id), INDEX IDX_8A9D0AAEA76ED395 (user_id), PRIMARY KEY(sk_paiement_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sk_paiement_user ADD CONSTRAINT FK_8A9D0AAEA1ABBA4D FOREIGN KEY (sk_paiement_id) REFERENCES sk_paiement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_paiement_user ADD CONSTRAINT FK_8A9D0AAEA76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_paiement DROP FOREIGN KEY FK_5C5551498D93D649');
        $this->addSql('DROP INDEX IDX_5C5551498D93D649 ON sk_paiement');
        $this->addSql('ALTER TABLE sk_paiement DROP user');
    }
}
