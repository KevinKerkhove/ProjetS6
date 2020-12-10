<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210130903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sous_groupe_etudiant (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_groupe_etudiant_sous_groupe (sous_groupe_etudiant_id INT NOT NULL, sous_groupe_id INT NOT NULL, INDEX IDX_646CA821712F8007 (sous_groupe_etudiant_id), INDEX IDX_646CA821614CDEC3 (sous_groupe_id), PRIMARY KEY(sous_groupe_etudiant_id, sous_groupe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_groupe_etudiant_etudiant (sous_groupe_etudiant_id INT NOT NULL, etudiant_id INT NOT NULL, INDEX IDX_1442B26A712F8007 (sous_groupe_etudiant_id), INDEX IDX_1442B26ADDEAB1A3 (etudiant_id), PRIMARY KEY(sous_groupe_etudiant_id, etudiant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sous_groupe_etudiant_sous_groupe ADD CONSTRAINT FK_646CA821712F8007 FOREIGN KEY (sous_groupe_etudiant_id) REFERENCES sous_groupe_etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_groupe_etudiant_sous_groupe ADD CONSTRAINT FK_646CA821614CDEC3 FOREIGN KEY (sous_groupe_id) REFERENCES sous_groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_groupe_etudiant_etudiant ADD CONSTRAINT FK_1442B26A712F8007 FOREIGN KEY (sous_groupe_etudiant_id) REFERENCES sous_groupe_etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_groupe_etudiant_etudiant ADD CONSTRAINT FK_1442B26ADDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant ADD inscrit TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_groupe_etudiant_sous_groupe DROP FOREIGN KEY FK_646CA821712F8007');
        $this->addSql('ALTER TABLE sous_groupe_etudiant_etudiant DROP FOREIGN KEY FK_1442B26A712F8007');
        $this->addSql('DROP TABLE sous_groupe_etudiant');
        $this->addSql('DROP TABLE sous_groupe_etudiant_sous_groupe');
        $this->addSql('DROP TABLE sous_groupe_etudiant_etudiant');
        $this->addSql('ALTER TABLE etudiant DROP inscrit');
    }
}
