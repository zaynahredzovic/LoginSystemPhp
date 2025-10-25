<?php
namespace App\Core;

use PDO;
use PDOException;

class Database{
    public static $con;
    public function __construct(){
        try {
            $config = new DatabaseConfig();
            $dsn = "{$config->driver}:host={$config->host};dbname={$config->database}";
            self::$con = new PDO($dsn, $config->username, $config->password);
        } catch (PDOException $e) {
            die('Database connection error: ' . $e->getMessage());
        }
    }
    public static function getIstance() {
        return new self();
    }
    public static function newInstance(){
        return new self();
    }
    public function read($query, $data=[]) {
        $stm = self::$con->prepare($query);
        $result = $stm->execute($data);

        return $result ? $stm->fetchAll(PDO::FETCH_OBJ) :false;
    }

    public function write($query, $data=[]){
        $stm = self::$con->prepare($query);
        return $stm->execute($data);
    }
}
