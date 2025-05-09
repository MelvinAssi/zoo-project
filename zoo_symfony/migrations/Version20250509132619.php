<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509132619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles TYPE TEXT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN users.roles IS '(DC2Type:array)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles TYPE JSON
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE users ALTER roles SET DEFAULT '["ROLE_USER"]'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN users.roles IS NULL
        SQL);
    }
}
