<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230822142150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D9D86650F');
        $this->addSql('DROP INDEX IDX_773DE69D9D86650F ON car');
        $this->addSql('ALTER TABLE car ADD created_by_id INT NOT NULL, CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DA76ED395 ON car (user_id)');
        $this->addSql('CREATE INDEX IDX_773DE69DB03A8386 ON car (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA76ED395');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DB03A8386');
        $this->addSql('DROP INDEX IDX_773DE69DA76ED395 ON car');
        $this->addSql('DROP INDEX IDX_773DE69DB03A8386 ON car');
        $this->addSql('ALTER TABLE car ADD user_id_id INT NOT NULL, DROP user_id, DROP created_by_id');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_773DE69D9D86650F ON car (user_id_id)');
    }
}
