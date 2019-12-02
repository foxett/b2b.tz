<?php

use Phinx\Migration\AbstractMigration;

class CreateTableOrders extends AbstractMigration
{
    public function up()
    {
        $sql = 'CREATE TABLE `orders` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL DEFAULT \'0\',
	`status` INT(11) NOT NULL DEFAULT \'0\',
	`cost` DECIMAL(10,2) NOT NULL DEFAULT \'0.00\',
	`created_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE=\'utf8_general_ci\'
ENGINE=InnoDB
;
';

        $this->execute($sql);
    }

    public function down()
    {
        $sql = 'DROP TABLE `orders`';
        $this->execute($sql);
    }
}
