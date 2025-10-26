<?php
namespace App\Core;
use App\Controllers\LoginController;
use App\Models\LoginModel;
use App\Core\Sessions;

class Login{
    private string $username;
    private string $password;
    private string $user;

    public function __construct(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $username = $this->username;
            $password = $this->password;
        }else {
            header("location: index.php");
            die;
        }
    }
    public function checkUser() {
        $errors= [];
        $loginModel = new LoginModel();
        if($loginModel->isInputEmpty($this->username, $this->password)){
            $errors["emptyInput"] = "Fill in all fields";
        }

        $this->user = $loginModel->getUser($this->username, $this->password);
        
        $loginController = new LoginController();
        if($loginController->isUsernameWrong($this->user)){
            $errors["loginIncorrect"]= "Incorrect login info!";
        }

        if(!$loginController->isUsernameWrong($this->user) && $loginController->isPasswordWrong($this->user)){
            $errors["loginIncorrect"]= "Incorrect login info!";
        }

        Sessions::sessionLoginErrors($errors);
        Sessions::newLoginSession($this->user);

        header("location: index.php?login=success");
    }

}
