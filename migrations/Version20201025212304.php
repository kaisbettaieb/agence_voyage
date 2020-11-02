<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025212304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre ADD compagnie_avion_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F1E72289F FOREIGN KEY (compagnie_avion_id) REFERENCES compagnie_avion (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F1E72289F ON offre (compagnie_avion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F1E72289F');
        $this->addSql('DROP INDEX IDX_AF86866F1E72289F ON offre');
        $this->addSql('ALTER TABLE offre DROP compagnie_avion_id');
    }
}
