<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250618065724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE post ADD COLUMN published_at DATETIME DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__post AS
            SELECT
              id,
              author_id,
              title,
              body,
              created_at,
              updated_at
            FROM
              post
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE post
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE post (
              id BLOB NOT NULL --(DC2Type:ulid)
              ,
              author_id BLOB NOT NULL --(DC2Type:ulid)
              ,
              title VARCHAR(80) NOT NULL,
              body CLOB DEFAULT NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              PRIMARY KEY(id),
              CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO post (
              id, author_id, title, body, created_at,
              updated_at
            )
            SELECT
              id,
              author_id,
              title,
              body,
              created_at,
              updated_at
            FROM
              __temp__post
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__post
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)
        SQL);
    }
}
