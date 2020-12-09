<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201209132112 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, civilite VARCHAR(255) NOT NULL, adresse1 VARCHAR(255) NOT NULL, adresse2 VARCHAR(255) DEFAULT NULL, adresse3 VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) NOT NULL, commune VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, telephone_mobile VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, email_responsable1 VARCHAR(255) DEFAULT NULL, email_responsable2 VARCHAR(255) DEFAULT NULL, choix VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_717E22E3E7927C74 (email), UNIQUE INDEX UNIQ_717E22E3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, promotion_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_4B98C21139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, annees DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_groupe (id INT AUTO_INCREMENT NOT NULL, groupe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_D4A67ED67A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE sous_groupe ADD CONSTRAINT FK_D4A67ED67A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_groupe DROP FOREIGN KEY FK_D4A67ED67A45358C');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21139DF194');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3A76ED395');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE sous_groupe');
        $this->addSql('DROP TABLE user');
    }
}
