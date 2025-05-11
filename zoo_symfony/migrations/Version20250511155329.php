<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250511155329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_animal TYPE VARCHAR(50)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_animal DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER created_by DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER updated_by DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_enclosure TYPE VARCHAR(50)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_enclosure DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER description SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER photo SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enclosure ALTER id_enclosure TYPE VARCHAR(50)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enclosure ALTER id_enclosure DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER INDEX enclosure_name_key RENAME TO UNIQ_E0F730635E237E06
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enclosure ALTER id_enclosure TYPE UUID
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enclosure ALTER id_enclosure SET DEFAULT 'gen_random_uuid()'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enclosure ALTER id_enclosure TYPE UUID
        SQL);
        $this->addSql(<<<'SQL'
            ALTER INDEX uniq_e0f730635e237e06 RENAME TO enclosure_name_key
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_animal TYPE UUID
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_animal SET DEFAULT 'gen_random_uuid()'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_animal TYPE UUID
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER created_by SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER updated_by SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_enclosure TYPE UUID
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_enclosure SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER id_enclosure TYPE UUID
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER description DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ALTER photo DROP NOT NULL
        SQL);
    }
}
