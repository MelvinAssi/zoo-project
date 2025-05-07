<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507104256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER INDEX users_username_key RENAME TO UNIQ_1483A5E9F85E0677
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_1483A5E9E7927C74
        SQL);
        $this->addSql(<<<'SQL'
            ALTER INDEX uniq_1483a5e9f85e0677 RENAME TO users_username_key
        SQL);
    }
}
