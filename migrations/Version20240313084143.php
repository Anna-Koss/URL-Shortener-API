<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313084143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE shortened_url (
                    id INT AUTO_INCREMENT NOT NULL,
                    original_url VARCHAR(2083) NOT NULL,
                    visit_counter INT DEFAULT 0 NOT NULL,
                    PRIMARY KEY(id)
                )
                DEFAULT CHARACTER SET utf8mb4
                COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
                ALTER TABLE shortened_url AUTO_INCREMENT = 1400;'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE shortened_url');
    }
}
