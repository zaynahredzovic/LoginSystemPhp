<?php
require_once "vendor/autoload.php";

use App\Core\Login;
use App\Core\Signup;
use App\Core\Sessions;
use App\Views\SigupView;
use App\Views\LoginView;

Sessions::start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>System</title>
</head>
<body>
    
    <form action="includes/login.inc.php" method="post">
        <h3>Login</h3>
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <button>Login</button>
    </form>

    <?php
        $login = new LoginView();
        $login->checkLoginErrors();
    ?>

    <form action="includes/signup.inc.php" method="post">
        <h3>Signup</h3>

    <?php
        $signup = new SigupView();
        $signup->signupInputs();
    ?>

        <button>Signup</button>
    </form>

    <?php
        $signup->checkSignupErrors();

    ?>

</body>
</html>