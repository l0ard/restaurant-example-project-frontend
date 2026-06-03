<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260603134526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE cart_line (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, food_id INT NOT NULL, cart_id INT NOT NULL, INDEX IDX_3EF1B4CFBA8E87C4 (food_id), INDEX IDX_3EF1B4CF1AD5CDBF (cart_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE food (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, stars INT NOT NULL, cook_time VARCHAR(255) NOT NULL, favorite TINYINT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE food_tag (food_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_F4EE573EBA8E87C4 (food_id), INDEX IDX_F4EE573EBAD26311 (tag_id), PRIMARY KEY (food_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE food_origin (food_id INT NOT NULL, origin_id INT NOT NULL, INDEX IDX_9EDF3CBDBA8E87C4 (food_id), INDEX IDX_9EDF3CBD56A273CC (origin_id), PRIMARY KEY (food_id, origin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE origin (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE cart_line ADD CONSTRAINT FK_3EF1B4CFBA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE cart_line ADD CONSTRAINT FK_3EF1B4CF1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE food_tag ADD CONSTRAINT FK_F4EE573EBA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE food_tag ADD CONSTRAINT FK_F4EE573EBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE food_origin ADD CONSTRAINT FK_9EDF3CBDBA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE food_origin ADD CONSTRAINT FK_9EDF3CBD56A273CC FOREIGN KEY (origin_id) REFERENCES origin (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_line DROP FOREIGN KEY FK_3EF1B4CFBA8E87C4');
        $this->addSql('ALTER TABLE cart_line DROP FOREIGN KEY FK_3EF1B4CF1AD5CDBF');
        $this->addSql('ALTER TABLE food_tag DROP FOREIGN KEY FK_F4EE573EBA8E87C4');
        $this->addSql('ALTER TABLE food_tag DROP FOREIGN KEY FK_F4EE573EBAD26311');
        $this->addSql('ALTER TABLE food_origin DROP FOREIGN KEY FK_9EDF3CBDBA8E87C4');
        $this->addSql('ALTER TABLE food_origin DROP FOREIGN KEY FK_9EDF3CBD56A273CC');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_line');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE food_tag');
        $this->addSql('DROP TABLE food_origin');
        $this->addSql('DROP TABLE origin');
        $this->addSql('DROP TABLE tag');
    }
}
