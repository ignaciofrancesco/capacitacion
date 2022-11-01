<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221101202826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE persona_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE circunscripcion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE localidad_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE organismo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE circunscripcion (id INT NOT NULL, circunscripcion VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE localidad (id INT NOT NULL, circunscripcion_id INT DEFAULT NULL, localidad VARCHAR(80) NOT NULL, feriados_locales VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4F68E01011A99F19 ON localidad (circunscripcion_id)');
        $this->addSql('CREATE TABLE organismo (id INT NOT NULL, localidad_id INT NOT NULL, codigo INT NOT NULL, organismo VARCHAR(255) NOT NULL, telefono VARCHAR(50) DEFAULT NULL, habilitado BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3DDAAC2D67707C89 ON organismo (localidad_id)');
        $this->addSql('ALTER TABLE localidad ADD CONSTRAINT FK_4F68E01011A99F19 FOREIGN KEY (circunscripcion_id) REFERENCES circunscripcion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE organismo ADD CONSTRAINT FK_3DDAAC2D67707C89 FOREIGN KEY (localidad_id) REFERENCES localidad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE persona');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE circunscripcion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE localidad_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE organismo_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE persona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE persona (id INT NOT NULL, apellido VARCHAR(255) NOT NULL, nombre VARCHAR(255) DEFAULT NULL, dni INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE localidad DROP CONSTRAINT FK_4F68E01011A99F19');
        $this->addSql('ALTER TABLE organismo DROP CONSTRAINT FK_3DDAAC2D67707C89');
        $this->addSql('DROP TABLE circunscripcion');
        $this->addSql('DROP TABLE localidad');
        $this->addSql('DROP TABLE organismo');
    }
}
