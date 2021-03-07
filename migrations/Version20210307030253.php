<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307030253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, cuit VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(15) NOT NULL, mail VARCHAR(90) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, province_id INT NOT NULL, location_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, published DATETIME DEFAULT NULL, INDEX IDX_FBD8E0F8979B1AD6 (company_id), INDEX IDX_FBD8E0F8E946114A (province_id), INDEX IDX_FBD8E0F864D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE province (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, document_type ENUM(\'DNI\', \'LC\', \'LE\', \'Pasaporte\', \'CI\'), document_number VARCHAR(36) NOT NULL, birth_date DATE NOT NULL, mail VARCHAR(90) NOT NULL, experience LONGTEXT NOT NULL, career VARCHAR(255) NOT NULL, year_career INT NOT NULL, published DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8E946114A FOREIGN KEY (province_id) REFERENCES province (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F864D218E FOREIGN KEY (location_id) REFERENCES location (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8979B1AD6');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F864D218E');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8E946114A');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE province');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE user');
    }
}
