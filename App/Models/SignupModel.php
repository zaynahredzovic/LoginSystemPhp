<?php
namespace App\Models;
use App\Core\Database;
use PDO;
final class SignupModel{
    private object $db;
    private string $table = 'logontbl';

    public function __construct(){
        $this->db = Database::getIstance();
    }

    public function getUsername($username){
        $query = "SELECT company FROM {$this->table} WHERE company =?;";
        $result= $this->db->read($query, [$username]);
        
        if(!$result){
            return null;
        }
        return $result;
    }

    public function setUser ($company, $username, $password){
        $query = "INSERT INTO {$this->table} (company, username, password) values (?,?,?);";
        
        $this->db->write($query, $company, $username, $password);
    }

}
