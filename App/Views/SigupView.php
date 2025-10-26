<?php
namespace App\Views;

class SigupView{
    private array $errors;

    private function __construct(){
        $errors=$this->errors;
    }

    public function signupInputs(){
        if (isset($_SESSION["signupData"]["company"]) && !isset($_SESSION["errorSignup"]["usernameTaken"])) {
            echo '<input type="text" name="company" placeholder="Company" value="'. $_SESSION["signupData"]["company"] .'">';
        }else {
            echo '<input type="text" name="company" placeholder="Company">';
        };

        echo '<input type="password" name="password" placeholder="Password">';

        if (isset($_SESSION["signupData"]["username"]) && !isset($_SESSION["errorSignup"]["emailUsed"]) && !isset($_SESSION["errorSignup"]["invalidEmail"])) {
            echo '<input type="email" name="username" placeholder="E-mail" value="'. $_SESSION["signup_data"]["email"] .'">';
        }else {
            echo '<input type="email" name="username" placeholder="E-mail">';
        };
    }

    public function checkSignupErrors(){
        if (isset($_SESSION["errorSignup"])) {
            $errors = $_SESSION["errorSignup"];

            echo "<br>";

            foreach ($errors as $error) {
                echo "<br>";
                echo '<p class="form-error">'. $error ."</p>";
            };

            unset($_SESSION["errorSignup"]);

        }elseif(isset($_GET["signup"]) && $_GET["signup"] ==="success"){
            echo "<br>";
            echo '<p class="form-success"> Signup success! </p>';
        }
    }
}

/*
function signupInputs(){

    if (isset($_SESSION["signup_data"]["company"]) && !isset($_SESSION["error_signup"]["username_taken"])) {
        echo '<input type="text" name="company" placeholder="Company" value="'. $_SESSION["signup_data"]["company"] .'">';
    }else {
        echo '<input type="text" name="company" placeholder="Company">';
    };

    echo '<input type="password" name="pwd" placeholder="Password">';

    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["error_signup"]["email_used"]) && !isset($_SESSION["error_signup"]["invalid_email"])) {
        echo '<input type="email" name="email" placeholder="E-mail" value="'. $_SESSION["signup_data"]["email"] .'">';
    }else {
        echo '<input type="email" name="email" placeholder="E-mail">';
    };
}




