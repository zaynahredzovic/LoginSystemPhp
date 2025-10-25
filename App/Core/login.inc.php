<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    require_once "dbh.inc.php";

    

    try {

        require_once "login_model.onc.php";
        require_once "login_contr.inc.php";



        //ERROR HANDLERS
        $errors = [];
        if(isInputEmpty($username, $pwd, )){
            $errors["empty_input"] = "Fill in all fields";
        };

        $result = getUser($pdo, $username);

        if(isUsernameWrong($result)){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        if(!isUsernameWrong($result) && isPasswordWrong($pwd, $result["pwd"])){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        

        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["error_login"] = $errors;

            header("location: ../index.php");
            die();
        };

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result;
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]) ;

        $_SESSION['last_regeneration'] = time();
        
        header("location: ../index.php?login=success");
        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}else {
    header("location: ../index.php");
    die();
}