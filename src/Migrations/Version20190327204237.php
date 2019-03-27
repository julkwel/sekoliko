<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190327204237 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_discipline ADD ets_nom VARCHAR(100) DEFAULT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) DEFAULT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_discipline_list ADD ets_nom VARCHAR(100) DEFAULT NULL, ADD ets_adresse LONGTEXT DEFAULT NULL, ADD ets_responsable VARCHAR(100) DEFAULT NULL, ADD ets_phone VARCHAR(100) DEFAULT NULL, ADD ets_email VARCHAR(150) DEFAULT NULL, ADD ets_logo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sk_discipline DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
        $this->addSql('ALTER TABLE sk_discipline_list DROP ets_nom, DROP ets_adresse, DROP ets_responsable, DROP ets_phone, DROP ets_email, DROP ets_logo');
    }
}
