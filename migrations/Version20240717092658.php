<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717092658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students ADD classe_id INT DEFAULT NULL, ADD regime_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB28F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB235E7D534 FOREIGN KEY (regime_id) REFERENCES regime (id)');
        $this->addSql('CREATE INDEX IDX_A4698DB28F5EA509 ON students (classe_id)');
        $this->addSql('CREATE INDEX IDX_A4698DB235E7D534 ON students (regime_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB28F5EA509');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB235E7D534');
        $this->addSql('DROP INDEX IDX_A4698DB28F5EA509 ON students');
        $this->addSql('DROP INDEX IDX_A4698DB235E7D534 ON students');
        $this->addSql('ALTER TABLE students DROP classe_id, DROP regime_id');
    }
}
