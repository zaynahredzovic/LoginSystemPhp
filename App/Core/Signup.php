<?php   
namespace App\Core;
use App\Controllers\SignupController;
use App\Models\SignupModel;
use App\Core\Sessions;

class Signup{
    private string $company;
    private string $username;
    private string $password;

    public function __construct(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $company = $this->company;
            $username = $this->username;
            $password = $this->password;
        }else {
            header("location: index.php");
            die;
        }
    }

    public function checkSignup(){
        $errors=[];
        $signupController = new SignupController();
        if($signupController->isInputEmpty($this->company, $this->username, $this->password)){
            $errors["emptyInput"] = "Fill in all fields";
        }

        if($signupController->isEmailValid($this->username)){
        $errors["invalidEmail"] = "Invalid email";
        }

        if($signupController->isEmailTaken($this->username)){
            $errors["usernameTaken"] = "Email is taken";
        }

        Sessions::sessionSignupErrors($errors, $this->company, $this->username);

        $user = new SignupModel();
        $user->setUser($this->company, $this->username, $this->password);

        header("location: index.php?signup=success");
    }
}