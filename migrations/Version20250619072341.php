<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250619072341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__post AS
            SELECT
              id,
              author_id,
              title,
              body,
              created_at,
              updated_at,
              published_at
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
              published_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
              ,
              PRIMARY KEY(id),
              CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON
              UPDATE
                NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO post (
              id, author_id, title, body, created_at,
              updated_at, published_at
            )
            SELECT
              id,
              author_id,
              title,
              body,
              created_at,
              updated_at,
              published_at
            FROM
              __temp__post
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__post
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD COLUMN timezone VARCHAR(64) NOT NULL
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
              published_at,
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
              published_at DATETIME DEFAULT NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              PRIMARY KEY(id),
              CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO post (
              id, author_id, title, body, published_at,
              created_at, updated_at
            )
            SELECT
              id,
              author_id,
              title,
              body,
              published_at,
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
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__user AS
            SELECT
              id,
              username,
              roles,
              password,
              email,
              created_at,
              updated_at
            FROM
              user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (
              id BLOB NOT NULL --(DC2Type:ulid)
              ,
              username VARCHAR(26) NOT NULL,
              roles CLOB NOT NULL --(DC2Type:json)
              ,
              password VARCHAR(255) NOT NULL,
              email VARCHAR(75) NOT NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              PRIMARY KEY(id)
            )
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO user (
              id, username, roles, password, email,
              created_at, updated_at
            )
            SELECT
              id,
              username,
              roles,
              password,
              email,
              created_at,
              updated_at
            FROM
              __temp__user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON user (username)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)
        SQL);
    }
}
