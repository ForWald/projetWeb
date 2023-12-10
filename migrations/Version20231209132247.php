<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231209132247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_exercice (id INT AUTO_INCREMENT NOT NULL, exercice_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_DC9F862789D40298 (exercice_id), INDEX IDX_DC9F8627BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, niveau_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, video VARCHAR(255) NOT NULL, description_si_haltere VARCHAR(255) DEFAULT NULL, video_si_haltere VARCHAR(255) DEFAULT NULL, INDEX IDX_E418C74DB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frequence (id INT AUTO_INCREMENT NOT NULL, nb_jours INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objectif (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_exercice (id INT AUTO_INCREMENT NOT NULL, exercice_id INT NOT NULL, seance_id INT NOT NULL, ordre INT NOT NULL, temps DOUBLE PRECISION DEFAULT NULL, nb_rep INT DEFAULT NULL, temps_repos DOUBLE PRECISION NOT NULL, nb_series INT NOT NULL, INDEX IDX_475F6E2589D40298 (exercice_id), INDEX IDX_475F6E25E3797A94 (seance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_seance (id INT AUTO_INCREMENT NOT NULL, programme_id INT NOT NULL, seance_id INT NOT NULL, ordre INT NOT NULL, INDEX IDX_A22DFA5162BB7AEE (programme_id), INDEX IDX_A22DFA51E3797A94 (seance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme (id INT AUTO_INCREMENT NOT NULL, objectif_id INT NOT NULL, niveau_id INT NOT NULL, frequence_id INT NOT NULL, nom_programme VARCHAR(255) NOT NULL, halteres TINYINT(1) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3DDCB9FF157D1AD4 (objectif_id), INDEX IDX_3DDCB9FFB3E9C81 (niveau_id), INDEX IDX_3DDCB9FF8E487805 (frequence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, niveau_id INT NOT NULL, nom VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DF7DFD0EBCF5E72D (categorie_id), INDEX IDX_DF7DFD0EB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_exercice ADD CONSTRAINT FK_DC9F862789D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE categorie_exercice ADD CONSTRAINT FK_DC9F8627BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE ordre_exercice ADD CONSTRAINT FK_475F6E2589D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE ordre_exercice ADD CONSTRAINT FK_475F6E25E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE ordre_seance ADD CONSTRAINT FK_A22DFA5162BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id)');
        $this->addSql('ALTER TABLE ordre_seance ADD CONSTRAINT FK_A22DFA51E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF157D1AD4 FOREIGN KEY (objectif_id) REFERENCES objectif (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF8E487805 FOREIGN KEY (frequence_id) REFERENCES frequence (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_exercice DROP FOREIGN KEY FK_DC9F862789D40298');
        $this->addSql('ALTER TABLE categorie_exercice DROP FOREIGN KEY FK_DC9F8627BCF5E72D');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DB3E9C81');
        $this->addSql('ALTER TABLE ordre_exercice DROP FOREIGN KEY FK_475F6E2589D40298');
        $this->addSql('ALTER TABLE ordre_exercice DROP FOREIGN KEY FK_475F6E25E3797A94');
        $this->addSql('ALTER TABLE ordre_seance DROP FOREIGN KEY FK_A22DFA5162BB7AEE');
        $this->addSql('ALTER TABLE ordre_seance DROP FOREIGN KEY FK_A22DFA51E3797A94');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF157D1AD4');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFB3E9C81');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF8E487805');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EBCF5E72D');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EB3E9C81');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_exercice');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE frequence');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE objectif');
        $this->addSql('DROP TABLE ordre_exercice');
        $this->addSql('DROP TABLE ordre_seance');
        $this->addSql('DROP TABLE programme');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
