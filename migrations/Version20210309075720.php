<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309075720 extends AbstractMigration
{

    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, province_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, cuit VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(15) NOT NULL, mail VARCHAR(90) NOT NULL, INDEX IDX_4FBF094F64D218E (location_id), INDEX IDX_4FBF094FE946114A (province_id), UNIQUE INDEX UNIQ_4FBF094FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, published DATETIME DEFAULT NULL, INDEX IDX_FBD8E0F8979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, province_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5E9E89CBE946114A (province_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE province (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, document_type ENUM(\'DNI\', \'LC\', \'LE\', \'Pasaporte\', \'CI\'), document_number VARCHAR(36) NOT NULL, birth_date DATE NOT NULL, mail VARCHAR(90) NOT NULL, experience LONGTEXT NOT NULL, career VARCHAR(255) NOT NULL, year_career INT NOT NULL, published DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_B723AF33A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FE946114A FOREIGN KEY (province_id) REFERENCES province (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBE946114A FOREIGN KEY (province_id) REFERENCES province (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8979B1AD6');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F64D218E');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FE946114A');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBE946114A');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA76ED395');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33A76ED395');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE province');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE user');
    }

    public function postUp(Schema $schema) : void{
        /* Provinces */
        $this->connection->exec('INSERT INTO province (name) VALUES ("Buenos Aires")');
        $this->connection->exec('INSERT INTO province (name) VALUES ("Córdoba")');
        $this->connection->exec('INSERT INTO province (name) VALUES ("Mendoza")');

        /* Locations */
        $this->connection->exec('INSERT INTO location (name, province_id) VALUES ("Quilmes", 1)');
        $this->connection->exec('INSERT INTO location (name, province_id) VALUES ("Banfield", 1)');
        $this->connection->exec('INSERT INTO location (name, province_id) VALUES ("Temperley", 1)');

        $this->connection->exec('INSERT INTO location (name, province_id) VALUES ("Alta Garcia", 2)');
        $this->connection->exec('INSERT INTO location (name, province_id) VALUES ("Cosquín", 2)');

        $this->connection->exec('INSERT INTO location (name, province_id) VALUES ("Godoy Cruz", 3)');

        /* Users */
        $this->connection->exec('INSERT INTO user (email, roles, password) VALUES ("admin@gmail.com", \'["ROLE_ADMIN"]\',"$argon2id$v=19$m=65536,t=4,p=1$T2JqbTZlVTVGcklkSnBQNA$VHx98UF19dNeeDCI6vRa6r8zPMR19CuZV+BJSbBzVO8")');

        $this->connection->exec('INSERT INTO user (email, roles, password) VALUES ("empresa@gmail.com", \'["ROLE_COMPANY"]\',"$argon2id$v=19$m=65536,t=4,p=1$T2JqbTZlVTVGcklkSnBQNA$VHx98UF19dNeeDCI6vRa6r8zPMR19CuZV+BJSbBzVO8")');

        $this->connection->exec('INSERT INTO user (email, roles, password) VALUES ("estudiante@gmail.com", \'["ROLE_STUDENT"]\',"$argon2id$v=19$m=65536,t=4,p=1$T2JqbTZlVTVGcklkSnBQNA$VHx98UF19dNeeDCI6vRa6r8zPMR19CuZV+BJSbBzVO8")');

        $this->connection->exec('INSERT INTO user (email, roles, password) VALUES ("estudiante1@gmail.com", \'["ROLE_STUDENT"]\',"$argon2id$v=19$m=65536,t=4,p=1$T2JqbTZlVTVGcklkSnBQNA$VHx98UF19dNeeDCI6vRa6r8zPMR19CuZV+BJSbBzVO8")');

        /* Student */
        $this->connection->exec('INSERT INTO student (user_id, name, surname, document_type, document_number, birth_date, mail, experience, career, year_career, published) VALUES (3, "Juan", "Gomez", "DNI", "36285996", "2000-05-03", "estudiante@gmail.com", "Soy un programador con un gran ambición de interiorizarme profundamente en todas las áreas del desarrollo web y desempeñarme como desarrollador full-stack.", "Ingeniería en Informática", 2019, "2021-03-10 15:09:12")');

        $this->connection->exec('INSERT INTO student (user_id, name, surname, document_type, document_number, birth_date, mail, experience, career, year_career, published) VALUES (4, "Diego", "Roldan", "DNI", "34252698", "1992-07-09", "estudiante1@gmail.com", "Actualmente estoy estudiando para obtener el título de Analista Programador Universitario y busco un empleo en la industria del software que me permita obtener experiencia profesional y demostrar mis capacidades.", "Analista de Sistemas", 2017, "2021-03-10 15:12:51")');

        /* Company */
        $this->connection->exec('INSERT INTO company (location_id, province_id, user_id, name, cuit, address, phone, mail) VALUES (1, 1, 2, "Soft SA", "20326958545", "Juan B Justo", "11 256698523", "empresa@gmail.com")');

         /* Job */
        $this->connection->exec('INSERT INTO job (company_id, title, description, start_date, end_date, published) VALUES (1, "Programador Java", "Sumate como java software engineer a una importante empresa de software argentina orientada al sector de videojuegos, con sede en buenos aires, mendoza, berlín y montevideo, creadora de varias apps de entretenimiento que superan los 700 millones de disfrutas de las apps free- to- play, este rol es para vos!¿qué necesitás para ser parte del equipo?experiencia de +5 años en back end en java, kotlin, go o python (excluyente en alguna de esas tecnologías).conocer o desarrollar en java 8 (excluyente).experiencia implementando buenas prácticas (tdd, solid, clean code, pair programming).estudios terciarios o universitarios en sistemas o carreras dentro de empresas producto (deseable).flexibilidad para aprender otras valoran perfiles con experiencia en aws y parte de un equipo de desarrollo que cuenta con integrantes.", "2021-03-11", "2021-03-25", "2021-03-10 15:23:12")');

        $this->connection->exec('INSERT INTO job (company_id, title, description, start_date, end_date, published) VALUES (1, "Desarrolladores Sin Experiencia", "Dirigido a estudiantes de la fiuna fundados conocimientos y experiencia en python y javascript orientado al backend (nodejs). amplios conocimientos en manejo de bases de datos: mysql, postgresql. (plus contar con conocimientos de base de datos no relacionales.) experiencia en desarrollo en ambientes linux (físico,virtual, basado en contenedores).", "2021-03-15", "2021-04-20", "2021-03-10 15:24:18")');

        $this->connection->exec('INSERT INTO job (company_id, title, description, start_date, end_date, published) VALUES (1, "Backend Laravel Developer", "Buscamos a unx PHP Software Developer a nuestro equipo de desarrollo. Buscamos a alguien que le apasionen las buenas practicas tecnológicas y la calidad de código. Vas a poder trabajar distintos tipos de proyectos, donde vas a poder aportar, aprender y desarrollar tu plan de carrera en un buen clima de trabajo.", "2021-03-15", "2021-06-05", null)');
    }
}
