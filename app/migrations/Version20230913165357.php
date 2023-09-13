<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913165357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, start_date DATETIME DEFAULT NULL, duration TIME DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, modified_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_guest (event_id INT NOT NULL, guest_id INT NOT NULL, INDEX IDX_EDAC2B1971F7E88B (event_id), INDEX IDX_EDAC2B199A4AA658 (guest_id), PRIMARY KEY(event_id, guest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, guest_group_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, age_group VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, modified_date DATETIME NOT NULL, INDEX IDX_ACB79A35817E1138 (guest_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, modified_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_access_id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, modified_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D6494F0AEA2B (user_access_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_access (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_guest ADD CONSTRAINT FK_EDAC2B1971F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_guest ADD CONSTRAINT FK_EDAC2B199A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_ACB79A35817E1138 FOREIGN KEY (guest_group_id) REFERENCES guest_group (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494F0AEA2B FOREIGN KEY (user_access_id) REFERENCES user_access (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE event_guest DROP FOREIGN KEY FK_EDAC2B1971F7E88B');
        $this->addSql('ALTER TABLE event_guest DROP FOREIGN KEY FK_EDAC2B199A4AA658');
        $this->addSql('ALTER TABLE guest DROP FOREIGN KEY FK_ACB79A35817E1138');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494F0AEA2B');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE event_guest');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP TABLE guest_group');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_access');
    }
}
