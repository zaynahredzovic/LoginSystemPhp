<?php
namespace App\Controllers;

use App\Views\SignupView;
use App\Models\SignupModel;
use App\Core\Sessions;

class SignupController{
    public function index(){
        (new SignupView())->render();
    }

    public function register(){
        $company = $_POST['company'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $model = new SignupModel();
        $result = $model->processSignup($company, $username, $password);

        if($result['success']){
            header("Location: /?signup=success");
            exit;
        } else {
            Sessions::sessionSignupErrors($result['errors'], $company, $username);
            header("Location: /signup");
            exit;
        }
    }
}