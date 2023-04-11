<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230411151047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coche (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, marca VARCHAR(255) NOT NULL, modelo VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, cv INT NOT NULL, INDEX IDX_A1981CD4DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coche_incidente (id INT AUTO_INCREMENT NOT NULL, incidente_id INT DEFAULT NULL, coche_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_5EAEC85420E75B71 (incidente_id), INDEX IDX_5EAEC854F4621E56 (coche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incidente (id INT AUTO_INCREMENT NOT NULL, tipo_incidente_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_1285808193B40571 (tipo_incidente_id), INDEX IDX_12858081DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, coche_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, fecha DATE NOT NULL, hora_inicio VARCHAR(255) NOT NULL, INDEX IDX_188D2E3BF4621E56 (coche_id), INDEX IDX_188D2E3BDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_incidente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coche ADD CONSTRAINT FK_A1981CD4DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE coche_incidente ADD CONSTRAINT FK_5EAEC85420E75B71 FOREIGN KEY (incidente_id) REFERENCES incidente (id)');
        $this->addSql('ALTER TABLE coche_incidente ADD CONSTRAINT FK_5EAEC854F4621E56 FOREIGN KEY (coche_id) REFERENCES coche (id)');
        $this->addSql('ALTER TABLE incidente ADD CONSTRAINT FK_1285808193B40571 FOREIGN KEY (tipo_incidente_id) REFERENCES tipo_incidente (id)');
        $this->addSql('ALTER TABLE incidente ADD CONSTRAINT FK_12858081DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BF4621E56 FOREIGN KEY (coche_id) REFERENCES coche (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coche DROP FOREIGN KEY FK_A1981CD4DB38439E');
        $this->addSql('ALTER TABLE coche_incidente DROP FOREIGN KEY FK_5EAEC85420E75B71');
        $this->addSql('ALTER TABLE coche_incidente DROP FOREIGN KEY FK_5EAEC854F4621E56');
        $this->addSql('ALTER TABLE incidente DROP FOREIGN KEY FK_1285808193B40571');
        $this->addSql('ALTER TABLE incidente DROP FOREIGN KEY FK_12858081DB38439E');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BF4621E56');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BDB38439E');
        $this->addSql('DROP TABLE coche');
        $this->addSql('DROP TABLE coche_incidente');
        $this->addSql('DROP TABLE incidente');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE tipo_incidente');
    }
}
