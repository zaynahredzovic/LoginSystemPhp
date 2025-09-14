<?php

declare(strict_types= 1);

function checkLoginErrors(){
    if(isset($_SESSION["error_login"])){
        $errors = $_SESSION["error_login"];

        echo "<br>";


        foreach ($errors as $error) {
            echo '<p class="form-error>"'.$error."</p><br>";
        }

        unset($_SESSION["error_login"]);

    }elseif (isset($_GET['login']) && $_GET['login']==='success') {
        echo "<br>";
        echo '<p class="form-success"> Login success! </p>';

    }
}