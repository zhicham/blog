<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210710143136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, contenu CLOB NOT NULL, featured_image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE articles_categories (articles_id INTEGER NOT NULL, categories_id INTEGER NOT NULL, PRIMARY KEY(articles_id, categories_id))');
        $this->addSql('CREATE INDEX IDX_DE004A0E1EBAF6CC ON articles_categories (articles_id)');
        $this->addSql('CREATE INDEX IDX_DE004A0EA21214B7 ON articles_categories (categories_id)');
        $this->addSql('CREATE TABLE articles_mots_cles (articles_id INTEGER NOT NULL, mots_cles_id INTEGER NOT NULL, PRIMARY KEY(articles_id, mots_cles_id))');
        $this->addSql('CREATE INDEX IDX_2927AB461EBAF6CC ON articles_mots_cles (articles_id)');
        $this->addSql('CREATE INDEX IDX_2927AB46C0BE80DB ON articles_mots_cles (mots_cles_id)');
        $this->addSql('CREATE TABLE commentaires (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, articles_id INTEGER DEFAULT NULL, contenu CLOB NOT NULL, email VARCHAR(255) DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_D9BEC0C41EBAF6CC ON commentaires (articles_id)');
        $this->addSql('CREATE TABLE mots_cles (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mot_cle VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE articles_categories');
        $this->addSql('DROP TABLE articles_mots_cles');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE mots_cles');
    }
}
