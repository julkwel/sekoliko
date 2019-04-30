<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412155446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_etudiant ADD motif_renvoie LONGTEXT DEFAULT NULL, ADD date_de_naissance VARCHAR(200) DEFAULT NULL, ADD mere VARCHAR(200) DEFAULT NULL, ADD pere VARCHAR(200) DEFAULT NULL, ADD contact_parent VARCHAR(100) DEFAULT NULL, ADD sexe VARCHAR(100) DEFAULT NULL, ADD is_passent TINYINT(1) DEFAULT \'0\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_etudiant DROP motif_renvoie, DROP date_de_naissance, DROP mere, DROP pere, DROP contact_parent, DROP sexe, DROP is_passent');
    }
}
