<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210710145123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_DE004A0EA21214B7');
        $this->addSql('DROP INDEX IDX_DE004A0E1EBAF6CC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__articles_categories AS SELECT articles_id, categories_id FROM articles_categories');
        $this->addSql('DROP TABLE articles_categories');
        $this->addSql('CREATE TABLE articles_categories (articles_id INTEGER NOT NULL, categories_id INTEGER NOT NULL, PRIMARY KEY(articles_id, categories_id), CONSTRAINT FK_DE004A0E1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_DE004A0EA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO articles_categories (articles_id, categories_id) SELECT articles_id, categories_id FROM __temp__articles_categories');
        $this->addSql('DROP TABLE __temp__articles_categories');
        $this->addSql('CREATE INDEX IDX_DE004A0EA21214B7 ON articles_categories (categories_id)');
        $this->addSql('CREATE INDEX IDX_DE004A0E1EBAF6CC ON articles_categories (articles_id)');
        $this->addSql('DROP INDEX IDX_2927AB46C0BE80DB');
        $this->addSql('DROP INDEX IDX_2927AB461EBAF6CC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__articles_mots_cles AS SELECT articles_id, mots_cles_id FROM articles_mots_cles');
        $this->addSql('DROP TABLE articles_mots_cles');
        $this->addSql('CREATE TABLE articles_mots_cles (articles_id INTEGER NOT NULL, mots_cles_id INTEGER NOT NULL, PRIMARY KEY(articles_id, mots_cles_id), CONSTRAINT FK_2927AB461EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2927AB46C0BE80DB FOREIGN KEY (mots_cles_id) REFERENCES mots_cles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO articles_mots_cles (articles_id, mots_cles_id) SELECT articles_id, mots_cles_id FROM __temp__articles_mots_cles');
        $this->addSql('DROP TABLE __temp__articles_mots_cles');
        $this->addSql('CREATE INDEX IDX_2927AB46C0BE80DB ON articles_mots_cles (mots_cles_id)');
        $this->addSql('CREATE INDEX IDX_2927AB461EBAF6CC ON articles_mots_cles (articles_id)');
        $this->addSql('DROP INDEX IDX_D9BEC0C41EBAF6CC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaires AS SELECT id, articles_id, contenu, email, pseudo, created_at FROM commentaires');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('CREATE TABLE commentaires (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, articles_id INTEGER DEFAULT NULL, contenu CLOB NOT NULL COLLATE BINARY, email VARCHAR(255) DEFAULT NULL COLLATE BINARY, pseudo VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_D9BEC0C41EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaires (id, articles_id, contenu, email, pseudo, created_at) SELECT id, articles_id, contenu, email, pseudo, created_at FROM __temp__commentaires');
        $this->addSql('DROP TABLE __temp__commentaires');
        $this->addSql('CREATE INDEX IDX_D9BEC0C41EBAF6CC ON commentaires (articles_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_DE004A0E1EBAF6CC');
        $this->addSql('DROP INDEX IDX_DE004A0EA21214B7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__articles_categories AS SELECT articles_id, categories_id FROM articles_categories');
        $this->addSql('DROP TABLE articles_categories');
        $this->addSql('CREATE TABLE articles_categories (articles_id INTEGER NOT NULL, categories_id INTEGER NOT NULL, PRIMARY KEY(articles_id, categories_id))');
        $this->addSql('INSERT INTO articles_categories (articles_id, categories_id) SELECT articles_id, categories_id FROM __temp__articles_categories');
        $this->addSql('DROP TABLE __temp__articles_categories');
        $this->addSql('CREATE INDEX IDX_DE004A0E1EBAF6CC ON articles_categories (articles_id)');
        $this->addSql('CREATE INDEX IDX_DE004A0EA21214B7 ON articles_categories (categories_id)');
        $this->addSql('DROP INDEX IDX_2927AB461EBAF6CC');
        $this->addSql('DROP INDEX IDX_2927AB46C0BE80DB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__articles_mots_cles AS SELECT articles_id, mots_cles_id FROM articles_mots_cles');
        $this->addSql('DROP TABLE articles_mots_cles');
        $this->addSql('CREATE TABLE articles_mots_cles (articles_id INTEGER NOT NULL, mots_cles_id INTEGER NOT NULL, PRIMARY KEY(articles_id, mots_cles_id))');
        $this->addSql('INSERT INTO articles_mots_cles (articles_id, mots_cles_id) SELECT articles_id, mots_cles_id FROM __temp__articles_mots_cles');
        $this->addSql('DROP TABLE __temp__articles_mots_cles');
        $this->addSql('CREATE INDEX IDX_2927AB461EBAF6CC ON articles_mots_cles (articles_id)');
        $this->addSql('CREATE INDEX IDX_2927AB46C0BE80DB ON articles_mots_cles (mots_cles_id)');
        $this->addSql('DROP INDEX IDX_D9BEC0C41EBAF6CC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaires AS SELECT id, articles_id, contenu, email, pseudo, created_at FROM commentaires');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('CREATE TABLE commentaires (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, articles_id INTEGER DEFAULT NULL, contenu CLOB NOT NULL, email VARCHAR(255) DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO commentaires (id, articles_id, contenu, email, pseudo, created_at) SELECT id, articles_id, contenu, email, pseudo, created_at FROM __temp__commentaires');
        $this->addSql('DROP TABLE __temp__commentaires');
        $this->addSql('CREATE INDEX IDX_D9BEC0C41EBAF6CC ON commentaires (articles_id)');
    }
}
