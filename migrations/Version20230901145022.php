<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230901145022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D63A8D613 FOREIGN KEY (rubriks_id) REFERENCES rubrik (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D63A8D613 ON post (rubriks_id)');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D63A8D613');
        $this->addSql('DROP INDEX IDX_5A8A6C8D63A8D613 ON post');
        $this->addSql('ALTER TABLE user DROP created_at');
    }
}
