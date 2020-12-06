<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201206112637 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE food (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(75) NOT NULL, type LONGTEXT NOT NULL, description LONGTEXT NOT NULL, picture LONGTEXT NOT NULL, price_restaurant DOUBLE PRECISION NOT NULL, price_takeway DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, price_restaurant DOUBLE PRECISION NOT NULL, price_takeway DOUBLE PRECISION NOT NULL, picture TINYTEXT NOT NULL, picture_description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_food (menu_id INT NOT NULL, food_id INT NOT NULL, INDEX IDX_1C77D9B9CCD7E912 (menu_id), INDEX IDX_1C77D9B9BA8E87C4 (food_id), PRIMARY KEY(menu_id, food_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_wine (menu_id INT NOT NULL, wine_id INT NOT NULL, INDEX IDX_9E439426CCD7E912 (menu_id), INDEX IDX_9E43942628A2BD76 (wine_id), PRIMARY KEY(menu_id, wine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, adress VARCHAR(150) NOT NULL, zip_code INT NOT NULL, city VARCHAR(50) NOT NULL, phone INT NOT NULL, portable INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(75) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wine (id INT AUTO_INCREMENT NOT NULL, name_cuvee VARCHAR(100) NOT NULL, domaine_name VARCHAR(100) NOT NULL, year INT NOT NULL, picture_url LONGTEXT NOT NULL, bio TINYINT(1) NOT NULL, bio_dynamic TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, price_restaurant DOUBLE PRECISION NOT NULL, price_takeway DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_food ADD CONSTRAINT FK_1C77D9B9CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_food ADD CONSTRAINT FK_1C77D9B9BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_wine ADD CONSTRAINT FK_9E439426CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_wine ADD CONSTRAINT FK_9E43942628A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_food DROP FOREIGN KEY FK_1C77D9B9BA8E87C4');
        $this->addSql('ALTER TABLE menu_food DROP FOREIGN KEY FK_1C77D9B9CCD7E912');
        $this->addSql('ALTER TABLE menu_wine DROP FOREIGN KEY FK_9E439426CCD7E912');
        $this->addSql('ALTER TABLE menu_wine DROP FOREIGN KEY FK_9E43942628A2BD76');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_food');
        $this->addSql('DROP TABLE menu_wine');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wine');
    }
}
