<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204141302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F7C54C8C93');
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F7FF9E1919');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93FF9E1919');
        $this->addSql('ALTER TABLE wine DROP FOREIGN KEY FK_560C6468FF9E1919');
        $this->addSql('DROP TABLE food_type');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP INDEX IDX_D43829F7C54C8C93 ON food');
        $this->addSql('DROP INDEX UNIQ_D43829F7FF9E1919 ON food');
        $this->addSql('ALTER TABLE food ADD type LONGTEXT NOT NULL, ADD picture LONGTEXT NOT NULL, DROP type_id, DROP picture_id_id');
        $this->addSql('DROP INDEX IDX_7D053A93FF9E1919 ON menu');
        $this->addSql('ALTER TABLE menu ADD picture TINYTEXT NOT NULL, DROP picture_id_id, DROP pictures');
        $this->addSql('DROP INDEX UNIQ_560C6468FF9E1919 ON wine');
        $this->addSql('ALTER TABLE wine ADD picture_url LONGTEXT NOT NULL, DROP picture_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE food_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, title_photo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description TINYTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE food ADD type_id INT DEFAULT NULL, ADD picture_id_id INT DEFAULT NULL, DROP type, DROP picture');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F7C54C8C93 FOREIGN KEY (type_id) REFERENCES food_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F7FF9E1919 FOREIGN KEY (picture_id_id) REFERENCES pictures (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D43829F7C54C8C93 ON food (type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D43829F7FF9E1919 ON food (picture_id_id)');
        $this->addSql('ALTER TABLE menu ADD picture_id_id INT DEFAULT NULL, ADD pictures VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP picture');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93FF9E1919 FOREIGN KEY (picture_id_id) REFERENCES pictures (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7D053A93FF9E1919 ON menu (picture_id_id)');
        $this->addSql('ALTER TABLE wine ADD picture_id_id INT DEFAULT NULL, DROP picture_url');
        $this->addSql('ALTER TABLE wine ADD CONSTRAINT FK_560C6468FF9E1919 FOREIGN KEY (picture_id_id) REFERENCES pictures (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_560C6468FF9E1919 ON wine (picture_id_id)');
    }
}
