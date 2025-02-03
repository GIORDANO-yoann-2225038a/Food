<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250203150131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mealplan ADD user_id INT NOT NULL, ADD recipe_id INT NOT NULL, ADD date DATE NOT NULL');
        $this->addSql('ALTER TABLE mealplan ADD CONSTRAINT FK_9436CB93A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE mealplan ADD CONSTRAINT FK_9436CB9359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_9436CB93A76ED395 ON mealplan (user_id)');
        $this->addSql('CREATE INDEX IDX_9436CB9359D8A214 ON mealplan (recipe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mealplan DROP FOREIGN KEY FK_9436CB93A76ED395');
        $this->addSql('ALTER TABLE mealplan DROP FOREIGN KEY FK_9436CB9359D8A214');
        $this->addSql('DROP INDEX IDX_9436CB93A76ED395 ON mealplan');
        $this->addSql('DROP INDEX IDX_9436CB9359D8A214 ON mealplan');
        $this->addSql('ALTER TABLE mealplan DROP user_id, DROP recipe_id, DROP date');
    }
}
