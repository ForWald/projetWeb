<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124180015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_exercice (id INT AUTO_INCREMENT NOT NULL, exercice_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_DC9F862789D40298 (exercice_id), INDEX IDX_DC9F8627BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_exercice (id INT AUTO_INCREMENT NOT NULL, exercice_id INT NOT NULL, seance_id INT NOT NULL, ordre INT NOT NULL, temps DOUBLE PRECISION DEFAULT NULL, nb_rep INT DEFAULT NULL, temps_repos DOUBLE PRECISION NOT NULL, nb_series INT NOT NULL, INDEX IDX_475F6E2589D40298 (exercice_id), INDEX IDX_475F6E25E3797A94 (seance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_seance (id INT AUTO_INCREMENT NOT NULL, programme_id INT NOT NULL, seance_id INT NOT NULL, ordre INT NOT NULL, INDEX IDX_A22DFA5162BB7AEE (programme_id), INDEX IDX_A22DFA51E3797A94 (seance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_exercice ADD CONSTRAINT FK_DC9F862789D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE categorie_exercice ADD CONSTRAINT FK_DC9F8627BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE ordre_exercice ADD CONSTRAINT FK_475F6E2589D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE ordre_exercice ADD CONSTRAINT FK_475F6E25E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE ordre_seance ADD CONSTRAINT FK_A22DFA5162BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id)');
        $this->addSql('ALTER TABLE ordre_seance ADD CONSTRAINT FK_A22DFA51E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE exercice_niveau DROP FOREIGN KEY FK_9250247189D40298');
        $this->addSql('ALTER TABLE exercice_niveau DROP FOREIGN KEY FK_92502471B3E9C81');
        $this->addSql('ALTER TABLE exercice_seance DROP FOREIGN KEY FK_6F22A1489D40298');
        $this->addSql('ALTER TABLE exercice_seance DROP FOREIGN KEY FK_6F22A14E3797A94');
        $this->addSql('ALTER TABLE seance_programme DROP FOREIGN KEY FK_63EEFB7162BB7AEE');
        $this->addSql('ALTER TABLE seance_programme DROP FOREIGN KEY FK_63EEFB71E3797A94');
        $this->addSql('DROP TABLE exercice_niveau');
        $this->addSql('DROP TABLE exercice_seance');
        $this->addSql('DROP TABLE seance_programme');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice_niveau (exercice_id INT NOT NULL, niveau_id INT NOT NULL, INDEX IDX_9250247189D40298 (exercice_id), INDEX IDX_92502471B3E9C81 (niveau_id), PRIMARY KEY(exercice_id, niveau_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE exercice_seance (exercice_id INT NOT NULL, seance_id INT NOT NULL, INDEX IDX_6F22A14E3797A94 (seance_id), INDEX IDX_6F22A1489D40298 (exercice_id), PRIMARY KEY(exercice_id, seance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE seance_programme (seance_id INT NOT NULL, programme_id INT NOT NULL, INDEX IDX_63EEFB71E3797A94 (seance_id), INDEX IDX_63EEFB7162BB7AEE (programme_id), PRIMARY KEY(seance_id, programme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE exercice_niveau ADD CONSTRAINT FK_9250247189D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_niveau ADD CONSTRAINT FK_92502471B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_seance ADD CONSTRAINT FK_6F22A1489D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_seance ADD CONSTRAINT FK_6F22A14E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seance_programme ADD CONSTRAINT FK_63EEFB7162BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seance_programme ADD CONSTRAINT FK_63EEFB71E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_exercice DROP FOREIGN KEY FK_DC9F862789D40298');
        $this->addSql('ALTER TABLE categorie_exercice DROP FOREIGN KEY FK_DC9F8627BCF5E72D');
        $this->addSql('ALTER TABLE ordre_exercice DROP FOREIGN KEY FK_475F6E2589D40298');
        $this->addSql('ALTER TABLE ordre_exercice DROP FOREIGN KEY FK_475F6E25E3797A94');
        $this->addSql('ALTER TABLE ordre_seance DROP FOREIGN KEY FK_A22DFA5162BB7AEE');
        $this->addSql('ALTER TABLE ordre_seance DROP FOREIGN KEY FK_A22DFA51E3797A94');
        $this->addSql('DROP TABLE categorie_exercice');
        $this->addSql('DROP TABLE ordre_exercice');
        $this->addSql('DROP TABLE ordre_seance');
    }
}
