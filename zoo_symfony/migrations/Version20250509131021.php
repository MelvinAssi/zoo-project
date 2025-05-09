<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509131021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles TYPE JSON
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles TYPE JSON
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles TYPE VARCHAR(30)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles SET DEFAULT '{"ROLE_USER"}'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles DROP NOT NULL
        SQL);
    }
}
