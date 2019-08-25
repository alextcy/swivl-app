<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190818193125 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE `classroom` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(100) NOT NULL,
                `enabled` tinyint(4) NOT NULL DEFAULT \'0\',
                `updated_at` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_general_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE classroom');

    }
}
