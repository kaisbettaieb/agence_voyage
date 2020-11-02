<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025192246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agence_location (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal INT NOT NULL, telephone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE billet_avion (id INT AUTO_INCREMENT NOT NULL, compagnie_avion_id INT NOT NULL, reservation_id INT NOT NULL, aeroport_depart VARCHAR(255) NOT NULL, aeroport_arrive VARCHAR(255) NOT NULL, heure_depart DOUBLE PRECISION NOT NULL, heure_arrive DOUBLE PRECISION NOT NULL, date_depart DATE NOT NULL, date_arrivee DATE NOT NULL, prix_hors_taxes DOUBLE PRECISION NOT NULL, num_siege INT NOT NULL, INDEX IDX_7D3280EB1E72289F (compagnie_avion_id), INDEX IDX_7D3280EBB83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, hotel_id INT NOT NULL, type VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_C509E4FF3243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnie_avion (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, code_postal INT NOT NULL, vile VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, date_facture DATE NOT NULL, mode_reglement VARCHAR(255) NOT NULL, INDEX IDX_FE866410B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, agence_id INT DEFAULT NULL, voiture_id INT DEFAULT NULL, date_prise_charge DATE NOT NULL, date_restitution DATE NOT NULL, INDEX IDX_5E9E89CBB83297E7 (reservation_id), INDEX IDX_5E9E89CBD725330D (agence_id), INDEX IDX_5E9E89CB181A8BA (voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location_chambre (id INT AUTO_INCREMENT NOT NULL, chambre_id INT DEFAULT NULL, reservation_id INT NOT NULL, nbr_nuits INT NOT NULL, date_entree DATETIME NOT NULL, date_sortie DATETIME NOT NULL, INDEX IDX_2B4CF75B9B177F54 (chambre_id), INDEX IDX_2B4CF75BB83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date_reservation DATETIME NOT NULL, nbr_nuits VARCHAR(255) NOT NULL, nbr_adultes INT NOT NULL, nbr_bebes INT NOT NULL, INDEX IDX_42C8495519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, numero_immatriculation VARCHAR(255) NOT NULL, type_vehicule VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, prix_hors_taxes_jours DOUBLE PRECISION NOT NULL, km_inclus DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE billet_avion ADD CONSTRAINT FK_7D3280EB1E72289F FOREIGN KEY (compagnie_avion_id) REFERENCES compagnie_avion (id)');
        $this->addSql('ALTER TABLE billet_avion ADD CONSTRAINT FK_7D3280EBB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBD725330D FOREIGN KEY (agence_id) REFERENCES agence_location (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB181A8BA FOREIGN KEY (voiture_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE location_chambre ADD CONSTRAINT FK_2B4CF75B9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE location_chambre ADD CONSTRAINT FK_2B4CF75BB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBD725330D');
        $this->addSql('ALTER TABLE location_chambre DROP FOREIGN KEY FK_2B4CF75B9B177F54');
        $this->addSql('ALTER TABLE billet_avion DROP FOREIGN KEY FK_7D3280EB1E72289F');
        $this->addSql('ALTER TABLE billet_avion DROP FOREIGN KEY FK_7D3280EBB83297E7');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410B83297E7');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBB83297E7');
        $this->addSql('ALTER TABLE location_chambre DROP FOREIGN KEY FK_2B4CF75BB83297E7');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB181A8BA');
        $this->addSql('DROP TABLE agence_location');
        $this->addSql('DROP TABLE billet_avion');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE compagnie_avion');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE location_chambre');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE vehicule');
    }
}
