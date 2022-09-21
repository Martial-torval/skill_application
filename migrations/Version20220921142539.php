<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220921142539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill ADD user_registered INT NOT NULL, CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user ADD first_name_id INT DEFAULT NULL, ADD skill_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649629BF02A FOREIGN KEY (first_name_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649629BF02A ON user (first_name_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6495585C142 ON user (skill_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill DROP user_registered, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649629BF02A');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6495585C142');
        $this->addSql('DROP INDEX IDX_8D93D649629BF02A ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D6495585C142 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP first_name_id, DROP skill_id');
    }
}
