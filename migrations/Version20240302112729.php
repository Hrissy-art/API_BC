<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240302112729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_cat_id INT DEFAULT NULL, category_name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1A9BE6A85 (parent_cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, material_name VARCHAR(255) DEFAULT NULL, coeff DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, date_order DATETIME DEFAULT NULL, date_render DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, material_id INT DEFAULT NULL, order_product_id INT DEFAULT NULL, quality_product_id INT DEFAULT NULL, status_order_id INT DEFAULT NULL, service_id INT DEFAULT NULL, quantity SMALLINT NOT NULL, INDEX IDX_2530ADE64584665A (product_id), INDEX IDX_2530ADE6E308AC6F (material_id), INDEX IDX_2530ADE6F65E9B0F (order_product_id), INDEX IDX_2530ADE6EDB4C5DA (quality_product_id), INDEX IDX_2530ADE61045CAE0 (status_order_id), INDEX IDX_2530ADE6ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name_product VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quality_product (id INT AUTO_INCREMENT NOT NULL, status_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, coeff DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birthday DATE NOT NULL, street_number SMALLINT NOT NULL, street_name VARCHAR(255) NOT NULL, town VARCHAR(255) NOT NULL, district VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A9BE6A85 FOREIGN KEY (parent_cat_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6F65E9B0F FOREIGN KEY (order_product_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6EDB4C5DA FOREIGN KEY (quality_product_id) REFERENCES quality_product (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE61045CAE0 FOREIGN KEY (status_order_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A9BE6A85');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6E308AC6F');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6F65E9B0F');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6EDB4C5DA');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE61045CAE0');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6ED5CA9E6');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE quality_product');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
    }
}
