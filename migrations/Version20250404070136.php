<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404070136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE smartphone (id INT AUTO_INCREMENT NOT NULL, vendor_id INT NOT NULL, type VARCHAR(255) NOT NULL, memory INT NOT NULL, color VARCHAR(255) NOT NULL, price NUMERIC(7, 2) NOT NULL, description LONGTEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_26B07E2EF603EE73 (vendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vendor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2EF603EE73 FOREIGN KEY (vendor_id) REFERENCES vendor (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2EF603EE73
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE smartphone
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vendor
        SQL);
    }
}
