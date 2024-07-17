<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717170027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scan_students DROP FOREIGN KEY FK_655249771AD8D010');
        $this->addSql('ALTER TABLE scan_students DROP FOREIGN KEY FK_655249772827AAD3');
        $this->addSql('DROP TABLE scan_students');
        $this->addSql('ALTER TABLE scan ADD student_id INT NOT NULL');
        $this->addSql('ALTER TABLE scan ADD CONSTRAINT FK_C4B3B3AECB944F1A FOREIGN KEY (student_id) REFERENCES students (id)');
        $this->addSql('CREATE INDEX IDX_C4B3B3AECB944F1A ON scan (student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scan_students (scan_id INT NOT NULL, students_id INT NOT NULL, INDEX IDX_655249771AD8D010 (students_id), INDEX IDX_655249772827AAD3 (scan_id), PRIMARY KEY(scan_id, students_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE scan_students ADD CONSTRAINT FK_655249771AD8D010 FOREIGN KEY (students_id) REFERENCES students (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE scan_students ADD CONSTRAINT FK_655249772827AAD3 FOREIGN KEY (scan_id) REFERENCES scan (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE scan DROP FOREIGN KEY FK_C4B3B3AECB944F1A');
        $this->addSql('DROP INDEX IDX_C4B3B3AECB944F1A ON scan');
        $this->addSql('ALTER TABLE scan DROP student_id');
    }
}
