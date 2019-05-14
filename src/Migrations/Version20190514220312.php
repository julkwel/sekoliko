<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514220312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_edt DROP FOREIGN KEY FK_591D9529EEC51E56');
        $this->addSql('ALTER TABLE sk_edt ADD CONSTRAINT FK_591D9529EEC51E56 FOREIGN KEY (matNom) REFERENCES sk_classe_matiere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_edt DROP FOREIGN KEY FK_591D9529EEC51E56');
        $this->addSql('ALTER TABLE sk_edt ADD CONSTRAINT FK_591D9529EEC51E56 FOREIGN KEY (matNom) REFERENCES sk_classe_matiere (id) ON DELETE SET NULL');
    }
}
