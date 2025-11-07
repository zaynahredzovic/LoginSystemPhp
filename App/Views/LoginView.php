<?php
namespace App\Views;


use App\Core\Sessions;

class LoginView{
    public function render() {
        if (isset($_SESSION['userId'])) {
            echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Welcome</title>
        </head>
        <body>
            <h1>Welcome, ' . ($_SESSION['userUsername'] ?? 'User') . '!</h1>
            <p>You are logged in successfully.</p>
            <a href="/logout">Logout</a>
        </body>
        </html>';
        } else {
            echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="/LoginSystem/css/style.css">
                <title>Login</title>
            </head>
            <body>
                <form action="/login" method="post">
                    <h3>Login</h3>';
                    $this->checkLoginErrors();
            echo'
                    <input type="text" name="email" placeholder="Email" values"' . ($_POST['email'] ?? '') . '">
                    <input type="password" name="password" placeholder="Password">
                    <button>Login</button>
                </form>
            </body>
            </html>';
        }
        
    }

    public function checkLoginErrors(){
        if(isset($_SESSION['errorLogin'])){
            $errors = $_SESSION['errorLogin'];
            
            echo "<br>";

            foreach ($errors as $error) {
            echo '<p class="form-error>"'. htmlspecialchars($error) ."</p><br>";
            }

            unset($_SESSION['errorLogin']);
        }elseif (isset($_GET['login']) && $_GET['login']==='success') {
            echo "<br>";
            echo '<p class="form-success"> Login success! </p>';
    }
    }
}
