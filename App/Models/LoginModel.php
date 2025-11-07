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
    public function getUser($username){
        $query = "SELECT * FROM {$this->table} WHERE username=?;";
        $result = $this->db->read($query, [$username]);

        if(!$result || count($result)===0){
            return null;
        }

        return $result[0];
    }

    public function processLogin($email, $password) {
        $errors = [];

        if($this->isInputEmpty($email, $password)){
            $errors["emptyInput"] = "Fill in all fields";
        }

        $user = $this->getUser($email);

        if(!$user){
            $errors["loginIncorrect"] = "Incorrect login info!";
        }

        if(!password_verify($password, $user['password'])){
            $errors["loginIncorrect"] = "Incorrect login info!";
        }

        if (empty($errors)) {
            return [
                'success' => true,
                'user' => $user
            ];
        } else {
            return[
                'success' =>false,
                'errors' => $errors
            ];
        }
        
    }
}

