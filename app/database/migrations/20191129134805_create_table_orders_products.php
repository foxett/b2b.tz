<?php

use Phinx\Migration\AbstractMigration;

class CreateTableOrdersProducts extends AbstractMigration
{
    public function up()
    {
        $sql = 'CREATE TABLE `order_products` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`order_id` INT(11) NOT NULL,
	`product_id` INT(11) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK_order_products_orders` (`order_id`),
	INDEX `FK_order_products_products` (`product_id`),
	CONSTRAINT `FK_order_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
	CONSTRAINT `FK_order_products_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
)
COLLATE=\'utf8_general_ci\'
ENGINE=InnoDB
;
';

        $this->execute($sql);
    }

    public function down()
    {
        $sql = 'DROP TABLE `order_products`';
        $this->execute($sql);
    }
}
