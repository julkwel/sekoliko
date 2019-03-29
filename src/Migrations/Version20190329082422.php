<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190329082422 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_book ADD user_id INT DEFAULT NULL, ADD date_debut DATETIME DEFAULT NULL, ADD date_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_book ADD CONSTRAINT FK_723DCE66A76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_723DCE66A76ED395 ON sk_book (user_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_book DROP FOREIGN KEY FK_723DCE66A76ED395');
        $this->addSql('DROP INDEX IDX_723DCE66A76ED395 ON sk_book');
        $this->addSql('ALTER TABLE sk_book DROP user_id, DROP date_debut, DROP date_fin');
    }
}
