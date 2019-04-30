<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412120142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sk_classe_matiere');
        $this->addSql('ALTER TABLE sk_salle ADD nombre_place INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_note DROP FOREIGN KEY FK_766597438F5EA509');
        $this->addSql('ALTER TABLE sk_note DROP FOREIGN KEY FK_76659743ABC1F7FE');
        $this->addSql('DROP INDEX IDX_766597438F5EA509 ON sk_note');
        $this->addSql('DROP INDEX IDX_76659743ABC1F7FE ON sk_note');
        $this->addSql('ALTER TABLE sk_note DROP classe_id, DROP prof_id, DROP coef');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_classe_matiere (id INT AUTO_INCREMENT NOT NULL, id_matiere_id INT DEFAULT NULL, id_classe_id INT DEFAULT NULL, id_prof_id INT DEFAULT NULL, coefficient INT NOT NULL, INDEX IDX_7D7CAB33F6B192E (id_classe_id), INDEX IDX_7D7CAB33755C5E8E (id_prof_id), INDEX IDX_7D7CAB3351E6528F (id_matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sk_classe_matiere ADD CONSTRAINT FK_7D7CAB3351E6528F FOREIGN KEY (id_matiere_id) REFERENCES sk_matiere (id)');
        $this->addSql('ALTER TABLE sk_classe_matiere ADD CONSTRAINT FK_7D7CAB33755C5E8E FOREIGN KEY (id_prof_id) REFERENCES sk_profs (id)');
        $this->addSql('ALTER TABLE sk_classe_matiere ADD CONSTRAINT FK_7D7CAB33F6B192E FOREIGN KEY (id_classe_id) REFERENCES sk_classe (id)');
        $this->addSql('ALTER TABLE sk_note ADD classe_id INT DEFAULT NULL, ADD prof_id INT DEFAULT NULL, ADD coef VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_note ADD CONSTRAINT FK_766597438F5EA509 FOREIGN KEY (classe_id) REFERENCES sk_classe (id)');
        $this->addSql('ALTER TABLE sk_note ADD CONSTRAINT FK_76659743ABC1F7FE FOREIGN KEY (prof_id) REFERENCES sk_profs (id)');
        $this->addSql('CREATE INDEX IDX_766597438F5EA509 ON sk_note (classe_id)');
        $this->addSql('CREATE INDEX IDX_76659743ABC1F7FE ON sk_note (prof_id)');
        $this->addSql('ALTER TABLE sk_salle DROP nombre_place');
    }
}
