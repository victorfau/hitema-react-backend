<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191024140149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recette_category (recette_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_B658F93989312FE9 (recette_id), INDEX IDX_B658F93912469DE2 (category_id), PRIMARY KEY(recette_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recette_category ADD CONSTRAINT FK_B658F93989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_category ADD CONSTRAINT FK_B658F93912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63903256915B');
        $this->addSql('DROP INDEX IDX_49BB63903256915B ON recette');
        $this->addSql('ALTER TABLE recette DROP relation_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recette_category');
        $this->addSql('ALTER TABLE recette ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63903256915B FOREIGN KEY (relation_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_49BB63903256915B ON recette (relation_id)');
    }
}
