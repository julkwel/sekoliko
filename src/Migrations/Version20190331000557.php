<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190331000557 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_classe_sk_matiere (sk_classe_id INT NOT NULL, sk_matiere_id INT NOT NULL, INDEX IDX_1FC34237ABCE875 (sk_classe_id), INDEX IDX_1FC3423AD2A0D02 (sk_matiere_id), PRIMARY KEY(sk_classe_id, sk_matiere_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_classe_sk_matiere ADD CONSTRAINT FK_1FC34237ABCE875 FOREIGN KEY (sk_classe_id) REFERENCES sk_classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_classe_sk_matiere ADD CONSTRAINT FK_1FC3423AD2A0D02 FOREIGN KEY (sk_matiere_id) REFERENCES sk_matiere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sk_classe_sk_matiere');
    }
}
