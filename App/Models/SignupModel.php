<?php
namespace App\Models;
use App\Core\Database;

final class SignupModel{
    private object $db;
    private string $table = 'logontbl';

    public function __construct(){
        $this->db = Database::getIstance();
    }

    public function getUsername($username){
        $query = "SELECT username FROM {$this->table} WHERE username = ?;";
        $result = $this->db->read($query, [$username]);
        
        return !empty($result);
    }

    public function setUser($company, $username, $password){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO {$this->table} (company, username, password) VALUES (?, ?, ?);";
        
        $this->db->write($query, [$company, $username, $hashedPassword]);
    }

    public function processSignup($company, $username, $password) {
        $errors = [];

        if (empty($company) || empty($username) || empty($password)) {
            $errors["emptyInput"] = "Fill in all fields";
        }

        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $errors["invalidEmail"] = "Invalid email";
        }

        if ($this->getUsername($username)) {
            $errors["usernameTaken"] = "Email is taken";
        }

        if (empty($errors)) {
            $this->setUser($company, $username, $password);
            return [
                'success' => true
            ];
        } else {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }
    }
}