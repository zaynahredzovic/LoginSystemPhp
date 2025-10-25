<?php   
namespace App\Controllers;
use App\Models\LoginModel;

class LoginController{
    public static function isUsernameWrong($result){
        if (!$result){
            return true;
        }else{
            return false;
        }
    }

    public static function isPasswordWrong($result){
        if(!$result){
            return true;
        }else{
            return false;
        }
    }
}
