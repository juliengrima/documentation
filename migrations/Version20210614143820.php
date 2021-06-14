<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614143820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C3568B40');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E419B20D');
        $this->addSql('DROP INDEX UNIQ_8D93D649E419B20D ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649C3568B40 ON user');
        $this->addSql('ALTER TABLE user DROP customers_id, DROP userSociety_id');
        $this->addSql('ALTER TABLE user_society ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_society ADD CONSTRAINT FK_55697FF8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55697FF8A76ED395 ON user_society (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD customers_id INT DEFAULT NULL, ADD userSociety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E419B20D FOREIGN KEY (userSociety_id) REFERENCES user_society (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E419B20D ON user (userSociety_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C3568B40 ON user (customers_id)');
        $this->addSql('ALTER TABLE user_society DROP FOREIGN KEY FK_55697FF8A76ED395');
        $this->addSql('DROP INDEX UNIQ_55697FF8A76ED395 ON user_society');
        $this->addSql('ALTER TABLE user_society DROP user_id');
    }
}
