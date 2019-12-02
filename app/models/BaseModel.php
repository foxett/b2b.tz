<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/28/2019
 * Time: 19:38
 */

class BaseModel
{
    protected $db;
    protected $connectoin;
    protected $table;

    public function init(){
        $this->db = new DB();
        $this->connectoin = $this->db->getConnection();
    }

    public function getDb(): DB{
        return $this->db;
    }

    public function find($id): ?array{
        $this->init();
        $found = $this->db->rawQuery('SELECT * FROM ' . $this->table . ' WHERE `id` = ' . mysqli_real_escape_string($this->connectoin, $id) . ';');

        if($found){
            return mysqli_fetch_assoc($found);
        }

        return null;

    }
}