<?php

use Phinx\Migration\AbstractMigration;

class CreateTableProducts extends AbstractMigration
{
    public function up()
    {
        $sql = '
            CREATE TABLE `products` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(50) NULL DEFAULT \'0\',
	`price` DECIMAL(10,2) UNSIGNED NULL DEFAULT \'0\',
	PRIMARY KEY (`id`)
)
COLLATE=\'utf8_general_ci\'
ENGINE=InnoDB
';

        $this->execute($sql);
    }

    public function down()
    {
        $sql = 'DROP TABLE `products`';
        $this->execute($sql);
    }
}
