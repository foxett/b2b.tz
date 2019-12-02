<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/29/2019
 * Time: 22:14
 */
class OrderModel extends BaseModel
{
    const STATUS_PAID = 1;
    const STATUS_NEW = 0
    ;
    public $db;
    protected $table = 'orders';

    protected $user_id = null;
    protected $status;
    public $cost;

    function __construct($user_id = 1, $status = self::STATUS_NEW){
        $this->init();
        $this->user_id = $user_id;
        $this->status = $status;
    }

    public function init()
    {
        parent::init();
        $this->db = parent::getDb();
    }

    public function create(){

        if($this->user_id === null){
            return null;
        }

        $query = "INSERT INTO %s (`user_id`, `status`, `cost`, `created_at`) VALUES ('%s', '%s', '%s',  NOW());";

        $result = $this->db->rawQuery(sprintf($query, $this->table, mysqli_real_escape_string($this->db->getConnection(), $this->user_id), $this->status, $this->cost));
        if($result){
            $recordId = $this->db->getConnection()->insert_id;

            $addedRecord = $this->db->rawQuery('SELECT * FROM ' . $this->table . ' WHERE `id` = ' . $recordId . ';');

            $this->db->getConnection()->close();

            return mysqli_fetch_assoc($addedRecord);
        }

        return null;

    }

    public function setStatus(int $id, int $status){
        $query = "UPDATE $this->table SET `status`= $status WHERE  `id` = $id;";

        return $this->db->rawQuery($query);
    }
}