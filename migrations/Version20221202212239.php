<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202212239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boarding_pass DROP FOREIGN KEY FK_DDFF6F33256915B');
        $this->addSql('DROP INDEX IDX_DDFF6F33256915B ON boarding_pass');
        $this->addSql('ALTER TABLE boarding_pass ADD gate VARCHAR(255) DEFAULT NULL, CHANGE relation_id passenger_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boarding_pass ADD CONSTRAINT FK_DDFF6F34502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
        $this->addSql('CREATE INDEX IDX_DDFF6F34502E565 ON boarding_pass (passenger_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boarding_pass DROP FOREIGN KEY FK_DDFF6F34502E565');
        $this->addSql('DROP INDEX IDX_DDFF6F34502E565 ON boarding_pass');
        $this->addSql('ALTER TABLE boarding_pass DROP gate, CHANGE passenger_id relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boarding_pass ADD CONSTRAINT FK_DDFF6F33256915B FOREIGN KEY (relation_id) REFERENCES passenger (id)');
        $this->addSql('CREATE INDEX IDX_DDFF6F33256915B ON boarding_pass (relation_id)');
    }
}
