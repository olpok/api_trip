<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202131120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boarding_pass (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, transport_type VARCHAR(255) NOT NULL, transport_number VARCHAR(255) DEFAULT NULL, seat VARCHAR(255) DEFAULT NULL, origin VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, departure_time DATETIME NOT NULL, INDEX IDX_DDFF6F33256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boarding_pass ADD CONSTRAINT FK_DDFF6F33256915B FOREIGN KEY (relation_id) REFERENCES passenger (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boarding_pass DROP FOREIGN KEY FK_DDFF6F33256915B');
        $this->addSql('DROP TABLE boarding_pass');
        $this->addSql('DROP TABLE passenger');
    }
}
