<?php   
namespace App\Models;
use App\Core\Database;

class LoginModel{
    private object $db;
    private string $table = 'logontbl';
    public function __construct() {
        $this->db = Database::getIstance();
    }
    public static function isInputEmpty(string $username, string $pwd){
        if(empty($username) || empty($pwd)){
            return true;
        }else{
            return false;
        };
    }
    public function getUser($username, $password){
        $query = "SELECT * FROM {$this->table} WHERE username=?;";
        $result = $this->db->read($query, [$username]);

        if(!$result){
            return null;
        }

        $user = $result[0];

        if(password_verify($password, $user['password'])){
            return $user;
        }

        return null;
    }

}

