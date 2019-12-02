<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/29/2019
 * Time: 10:30
 */
class ProductModel extends BaseModel
{
    public $db;
    protected $table = 'products';
    public $title = null;
    public $price = null;
    public $fillable = ['title', 'price'];

    function __construct($title = null, $price = null){
        $this->init();
        $this->title = $title;
        $this->price = $price;
    }

    public function init()
    {
       parent::init();
       $this->db = parent::getDb();
    }

    public function create(){

        if($this->title === null || $this->price === null){
            return null;
        }

        $query = "INSERT INTO %s (`title`, `price`) VALUES ('%s', '%s');";

        $result = $this->db->rawQuery(sprintf($query, $this->table, mysqli_real_escape_string($this->db->getConnection(), $this->title), $this->price));
        if($result){
            $recordId = $this->db->getConnection()->insert_id;

            $addedRecord = $this->db->rawQuery('SELECT * FROM ' . $this->table . ' WHERE `id` = ' . $recordId . ';');

            $this->db->getConnection()->close();

            return mysqli_fetch_assoc($addedRecord);
        }

        return null;

    }

    public function getAll(){
        $query = "SELECT * FROM $this->table;";
        $result = $this->db->rawQuery($query);
        $products = [];

        if($result){
            while($product = mysqli_fetch_assoc($result)){
                $products[] = $product;
            }

            return $products;
        }
        return null;
    }

    public function getProductsCost(array $products){
        $query ="SELECT sum(price) AS `cost` FROM %s WHERE `id` IN (%s);";
        $productIds = [];

        foreach ($products as $product){
            $productIds [] = $product->id;
        }

        $productsString = implode(', ', $productIds);
        $result = $this->db->rawQuery(sprintf($query, $this->table, $productsString));

        if($result){
            return mysqli_fetch_assoc($result);
        }

        return null;
    }

}