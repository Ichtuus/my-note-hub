<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201128174516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE my_note_hub_hub (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', creation_datetime DATETIME NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_4025F5B4A76ED395 (user_id), INDEX name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE my_note_hub_hub_user_role (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', hub_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', role VARCHAR(255) NOT NULL, creation_datetime DATETIME NOT NULL, INDEX IDX_CE95D363A76ED395 (user_id), INDEX IDX_CE95D3636C786081 (hub_id), UNIQUE INDEX unique_hub_user (user_id, hub_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE my_note_hub_note (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', hub_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', creator_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', note_title VARCHAR(70) NOT NULL, note_content VARCHAR(250) NOT NULL, note_first_link VARCHAR(150) DEFAULT NULL, note_second_link VARCHAR(150) DEFAULT NULL, note_third_link VARCHAR(150) DEFAULT NULL, creation_datetime DATETIME NOT NULL, UNIQUE INDEX UNIQ_BD4E4974E26DBBC (note_title), UNIQUE INDEX UNIQ_BD4E4977F63F433 (note_content), INDEX IDX_BD4E4976C786081 (hub_id), INDEX IDX_BD4E49761220EA6 (creator_id), INDEX creation_datetime (creation_datetime), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE my_note_hub_user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', hub_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(25) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(45) NOT NULL, api_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_49FAC8CAF85E0677 (username), UNIQUE INDEX UNIQ_49FAC8CAE7927C74 (email), UNIQUE INDEX UNIQ_49FAC8CA7BA2F5EB (api_token), INDEX IDX_49FAC8CA6C786081 (hub_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE my_note_hub_hub ADD CONSTRAINT FK_4025F5B4A76ED395 FOREIGN KEY (user_id) REFERENCES my_note_hub_user (id)');
        $this->addSql('ALTER TABLE my_note_hub_hub_user_role ADD CONSTRAINT FK_CE95D363A76ED395 FOREIGN KEY (user_id) REFERENCES my_note_hub_user (id)');
        $this->addSql('ALTER TABLE my_note_hub_hub_user_role ADD CONSTRAINT FK_CE95D3636C786081 FOREIGN KEY (hub_id) REFERENCES my_note_hub_hub (id)');
        $this->addSql('ALTER TABLE my_note_hub_note ADD CONSTRAINT FK_BD4E4976C786081 FOREIGN KEY (hub_id) REFERENCES my_note_hub_hub (id)');
        $this->addSql('ALTER TABLE my_note_hub_note ADD CONSTRAINT FK_BD4E49761220EA6 FOREIGN KEY (creator_id) REFERENCES my_note_hub_user (id)');
        $this->addSql('ALTER TABLE my_note_hub_user ADD CONSTRAINT FK_49FAC8CA6C786081 FOREIGN KEY (hub_id) REFERENCES my_note_hub_hub (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_note_hub_hub_user_role DROP FOREIGN KEY FK_CE95D3636C786081');
        $this->addSql('ALTER TABLE my_note_hub_note DROP FOREIGN KEY FK_BD4E4976C786081');
        $this->addSql('ALTER TABLE my_note_hub_user DROP FOREIGN KEY FK_49FAC8CA6C786081');
        $this->addSql('ALTER TABLE my_note_hub_hub DROP FOREIGN KEY FK_4025F5B4A76ED395');
        $this->addSql('ALTER TABLE my_note_hub_hub_user_role DROP FOREIGN KEY FK_CE95D363A76ED395');
        $this->addSql('ALTER TABLE my_note_hub_note DROP FOREIGN KEY FK_BD4E49761220EA6');
        $this->addSql('DROP TABLE my_note_hub_hub');
        $this->addSql('DROP TABLE my_note_hub_hub_user_role');
        $this->addSql('DROP TABLE my_note_hub_note');
        $this->addSql('DROP TABLE my_note_hub_user');
    }
}
