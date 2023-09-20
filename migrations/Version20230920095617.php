<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230920095617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rename user table to app_user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('RENAME TABLE user TO app_user');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('RENAME TABLE app_user TO user');
    }
}
