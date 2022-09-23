<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923100455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examens DROP FOREIGN KEY FK_B2E32DD710F3A34');
        $this->addSql('ALTER TABLE examens DROP FOREIGN KEY FK_B2E32DD7A9F87BD');
        $this->addSql('DROP INDEX IDX_B2E32DD7A9F87BD ON examens');
        $this->addSql('DROP INDEX IDX_B2E32DD710F3A34 ON examens');
        $this->addSql('ALTER TABLE examens ADD competences_id INT DEFAULT NULL, DROP title_id, DROP subtitle_id');
        $this->addSql('ALTER TABLE examens ADD CONSTRAINT FK_B2E32DD7A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id)');
        $this->addSql('CREATE INDEX IDX_B2E32DD7A660B158 ON examens (competences_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examens DROP FOREIGN KEY FK_B2E32DD7A660B158');
        $this->addSql('DROP INDEX IDX_B2E32DD7A660B158 ON examens');
        $this->addSql('ALTER TABLE examens ADD subtitle_id INT DEFAULT NULL, CHANGE competences_id title_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examens ADD CONSTRAINT FK_B2E32DD710F3A34 FOREIGN KEY (subtitle_id) REFERENCES competences (id)');
        $this->addSql('ALTER TABLE examens ADD CONSTRAINT FK_B2E32DD7A9F87BD FOREIGN KEY (title_id) REFERENCES competences (id)');
        $this->addSql('CREATE INDEX IDX_B2E32DD7A9F87BD ON examens (title_id)');
        $this->addSql('CREATE INDEX IDX_B2E32DD710F3A34 ON examens (subtitle_id)');
    }
}
