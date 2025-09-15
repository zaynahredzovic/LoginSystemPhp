<?php
    require_once "includes/config_session.inc.php";
    require_once "includes/signup_view.inc.php";
    require_once "includes/login_view.inc.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    
    <form action="includes/login.inc.php" method="post">
        <h3>Login</h3>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button>Login</button>
    </form>

    <?php
        checkLoginErrors();
    ?>

    <form action="includes/signup.inc.php" method="post">
        <h3>Signup</h3>

    <?php
        signupInputs();
    ?>

        <button>Signup</button>
    </form>

    <?php
    
    checkSignupErrors();

    ?>

</body>
</html>