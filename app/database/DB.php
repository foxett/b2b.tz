<?php

/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/29/2019
 * Time: 03:08
 */
class DB
{
    private $dbhost = 'localhost';
    private $dbname = 'production_db';
    private $dbuser = 'root';
    private $dbpassword = '';

    private $connection;

    /**
     * DB constructor.
     */
    function __construct(){
        $this->initConnection();
    }

    /**
     * creating connection to db
     */
    private function initConnection(): void{
      $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);
    }

    /**
     * @return mysqli
     */
    public function getConnection(): mysqli{
        return $this->connection;
    }

    public function rawQuery(string $queryString){

        $result = $this->connection->query($queryString);
        if($this->connection->error){
            var_dump($this->connection->error);
            echo '<br>';
        }

        return $result;
    }

    /**
     * closing connection with db
     */
    public function close(){
        mysqli_close($this->connection);
    }
}