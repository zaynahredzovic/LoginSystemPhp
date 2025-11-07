<?php
namespace App\Views;

use App\Core\Sessions;

class SignupView{
    public function render(){
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/LoginSystem/css/style.css">
            <title>Sign Up</title>
        </head>
        <body>
            <form action="/signup" method="post">
                <h3>Sign Up</h3>';

        $this->checkSignupErrors();
        $this->signupInputs();

        echo '
                <button>Sign Up</button>
            </form>
            <p>Already have an account? <a href="/">Login</a></p>
        </body>
        </html>';
    }

    public function signupInputs() {

        //company input
        if(isset($_SESSION["signupData"]['company']) && !isset($_SESSION['errorSignup']["usernameTaken"])){
            echo '<input type="text" name="company" placeholder="Company" value="'. htmlspecialchars($_SESSION["signupData"]["company"]) .'">';
        }else{
            echo '<input type="text" name="company" placeholder="Company">';
        }

        //email (username in the db) input
        if (isset($_SESSION["signupData"]["username"]) && !isset($_SESSION["errorSignup"]["usernameTaken"]) && !isset($_SESSION["errorSignup"]["invalidEmail"])) {
            echo '<input type="email" name="username" placeholder="E-mail" value="'. htmlspecialchars($_SESSION["signupData"]["username"]) .'">'; // Fixed: username not email
        } else {
            echo '<input type="email" name="username" placeholder="E-mail">';
        }

        //password input
        echo '<input type="password" name="password" placeholder="Password">';
    }

    public function checkSignupErrors(){
        if (isset($_SESSION["errorSignup"])) {
            $errors = $_SESSION["errorSignup"];

            echo '<div class="errors">';
            foreach ($errors as $error) {
                echo '<p class="form-error">'. htmlspecialchars($error) .'</p>';
            }
            echo '</div>';

            unset($_SESSION["errorSignup"]);
        } elseif(isset($_GET["signup"]) && $_GET["signup"] === "success") {
            echo '<p class="form-success">Signup success!</p>';
        }
    }
}






