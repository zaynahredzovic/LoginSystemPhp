<?php   
namespace App\Controllers;

use App\Views\LoginView;
use App\Models\LoginModel;
use App\Core\Sessions;

class LoginController{
    public function index(){
        (new LoginView())->render();
    }

    public function login(){
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $model = new LoginModel();
        $result = $model->processLogin($email, $password);

        if($result['success']){
            Sessions::newLoginSession($result['user']);
            header("Location: /");
            exit;
        }else{
            Sessions::sessionLoginErrors($result['errors']);
            header("Location: /");
            exit;
        }
    }
}
