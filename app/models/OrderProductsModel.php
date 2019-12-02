<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/29/2019
 * Time: 22:16
 */
class OrderProductsModel extends BaseModel
{
    public $db;
    protected $table = 'order_products';

    public $order_id = null;
    public $product_id = 0;

    function __construct(){
        $this->init();

    }

    public function init()
    {
        parent::init();
        $this->db = parent::getDb();
    }

    public function create(){

        if($this->order_id === null){
            return null;
        }

        $query = "INSERT INTO %s (`order_id`, `product_id`) VALUES ('%s', '%s');";

        $result = $this->db->rawQuery(sprintf($query, $this->table, mysqli_real_escape_string($this->db->getConnection(), $this->order_id),  mysqli_real_escape_string($this->db->getConnection(), $this->product_id)));
        if($result){
            $this->db->getConnection()->close();

            return true;
        }

        return null;

    }
}