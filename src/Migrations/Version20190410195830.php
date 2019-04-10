<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190410195830 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_matiere_sk_classe (sk_matiere_id INT NOT NULL, sk_classe_id INT NOT NULL, INDEX IDX_890B76DCAD2A0D02 (sk_matiere_id), INDEX IDX_890B76DC7ABCE875 (sk_classe_id), PRIMARY KEY(sk_matiere_id, sk_classe_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_matiere_sk_classe ADD CONSTRAINT FK_890B76DCAD2A0D02 FOREIGN KEY (sk_matiere_id) REFERENCES sk_matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_matiere_sk_classe ADD CONSTRAINT FK_890B76DC7ABCE875 FOREIGN KEY (sk_classe_id) REFERENCES sk_classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_matiere DROP FOREIGN KEY FK_A1BC20CA76AA3D43');
        $this->addSql('DROP INDEX IDX_A1BC20CA76AA3D43 ON sk_matiere');
        $this->addSql('ALTER TABLE sk_matiere DROP matClasse');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sk_matiere_sk_classe');
        $this->addSql('ALTER TABLE sk_matiere ADD matClasse INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_matiere ADD CONSTRAINT FK_A1BC20CA76AA3D43 FOREIGN KEY (matClasse) REFERENCES sk_classe (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A1BC20CA76AA3D43 ON sk_matiere (matClasse)');
    }
}
