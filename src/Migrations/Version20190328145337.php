<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190328145337 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_discipline_list DROP FOREIGN KEY FK_824EA63CA5522701');
        $this->addSql('ALTER TABLE sk_discipline_list ADD CONSTRAINT FK_824EA63CA5522701 FOREIGN KEY (discipline_id) REFERENCES sk_discipline (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_discipline_list DROP FOREIGN KEY FK_824EA63CA5522701');
        $this->addSql('ALTER TABLE sk_discipline_list ADD CONSTRAINT FK_824EA63CA5522701 FOREIGN KEY (discipline_id) REFERENCES sk_discipline (id)');
    }
}
