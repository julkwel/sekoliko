<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191028170310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reservation_user (reservation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9BAA1B21B83297E7 (reservation_id), INDEX IDX_9BAA1B21A76ED395 (user_id), PRIMARY KEY(reservation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_user ADD CONSTRAINT FK_9BAA1B21B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_user ADD CONSTRAINT FK_9BAA1B21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557F6F80F8');
        $this->addSql('DROP INDEX UNIQ_42C849557F6F80F8 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP reservator_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE reservation_user');
        $this->addSql('ALTER TABLE reservation ADD reservator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557F6F80F8 FOREIGN KEY (reservator_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849557F6F80F8 ON reservation (reservator_id)');
    }
}
