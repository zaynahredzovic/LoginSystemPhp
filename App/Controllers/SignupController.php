<?php
namespace App\Controllers;
use App\Models\SignupModel;

class SignupController{
    private string $company;
    private string $username; //email in pratice, username in db;
    private string $password;


    public function isInputEmpty($company,$username, $password){
        if (empty($company) || empty($username) || empty($password)){
            return true;
        }else{
            return false;
        }
    }

    public function isEmailValid($username){
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }        
    }

    public function isEmailTaken($username) {
        $user = new SignupModel();
        if($user->getUsername($username)){
            return true;
        }else{
            return false;
        }
    }

    public function createUser($company, $username, $password){
        $user = new SignupModel();
        $user->setUser($company, $username, $password);
    }
}