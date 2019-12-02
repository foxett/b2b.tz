<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/29/2019
 * Time: 02:44
 */
class ProductService
{
    /**
     * @param int $count
     * @return array
     */
    public static function generateProducts($count = 20) : array{
        $fakerFactory = new Faker\Factory();
        $faker = $fakerFactory::create();

        $products = [];

        for($i = 0; $i < $count; $i++){
            $model = new ProductModel($faker->realText(20), $faker->randomFloat(2, 1, 1000));
            $products[] = $model->create();
        }

        return $products;
    }

    /**
     * @return array|null
     */
    public static function getAll(){
        $model = new ProductModel();

        return $model->getAll();
    }
}