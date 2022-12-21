<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221221122220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boarding_pass (id INT AUTO_INCREMENT NOT NULL, voyage_id INT DEFAULT NULL, transport_type VARCHAR(255) NOT NULL, transport_number VARCHAR(255) DEFAULT NULL, origin VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, gate VARCHAR(255) DEFAULT NULL, seat VARCHAR(255) DEFAULT NULL, baggage_info VARCHAR(255) DEFAULT NULL, departure_time DATETIME NOT NULL, INDEX IDX_DDFF6F368C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, passenger_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3F9D89554502E565 (passenger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boarding_pass ADD CONSTRAINT FK_DDFF6F368C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boarding_pass DROP FOREIGN KEY FK_DDFF6F368C9E5AF');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554502E565');
        $this->addSql('DROP TABLE boarding_pass');
        $this->addSql('DROP TABLE passenger');
        $this->addSql('DROP TABLE voyage');
    }
}
