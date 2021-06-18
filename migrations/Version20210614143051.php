<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614143051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, phone1 INT DEFAULT NULL, phone2 INT DEFAULT NULL, phone3 INT DEFAULT NULL, UNIQUE INDEX UNIQ_62534E21A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT FK_62534E21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD customers_id INT DEFAULT NULL, ADD userSociety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E419B20D FOREIGN KEY (userSociety_id) REFERENCES user_society (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E419B20D ON user (userSociety_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C3568B40 ON user (customers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C3568B40');
        $this->addSql('DROP TABLE customers');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E419B20D');
        $this->addSql('DROP INDEX UNIQ_8D93D649E419B20D ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649C3568B40 ON user');
        $this->addSql('ALTER TABLE user DROP customers_id, DROP userSociety_id');
    }
}
