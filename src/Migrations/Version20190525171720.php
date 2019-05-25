<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190525171720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, DROP name_first_name, DROP name_last_name, CHANGE email_verification_token email_verification_token VARCHAR(255) DEFAULT NULL, CHANGE verified_at verified_at DATETIME DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE password_reset_token password_reset_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD name_first_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD name_last_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP first_name, DROP last_name, CHANGE email_verification_token email_verification_token VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE verified_at verified_at DATETIME DEFAULT \'NULL\', CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE password_reset_token password_reset_token VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
