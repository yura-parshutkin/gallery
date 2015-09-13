<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150913183813 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3AF346685E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subcategories (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6562A1CB5E237E06 (name), INDEX IDX_6562A1CB12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, sub_category_id INT NOT NULL, description VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_876E0D9F7BFE87C (sub_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subcategories ADD CONSTRAINT FK_6562A1CB12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9F7BFE87C FOREIGN KEY (sub_category_id) REFERENCES subcategories (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subcategories DROP FOREIGN KEY FK_6562A1CB12469DE2');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9F7BFE87C');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE subcategories');
        $this->addSql('DROP TABLE photos');
    }
}
