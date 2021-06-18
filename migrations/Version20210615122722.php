<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615122722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documentation (id INT AUTO_INCREMENT NOT NULL, customers_id_id INT DEFAULT NULL, document LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_73D5A93B4CA4FD72 (customers_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documentation ADD CONSTRAINT FK_73D5A93B4CA4FD72 FOREIGN KEY (customers_id_id) REFERENCES customers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE documentation');
    }
}
