<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230924201804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO user (lastname, firstname, email, birthday) VALUES ("Doe", "John", "webdev@prototyp.fr", "1981-01-14")');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM user where id = 1');

    }
}
