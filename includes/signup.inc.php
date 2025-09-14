<?php   

if($_SERVER["REQUEST_METHOD"]==="POST"){

    require_once"dbh.inc.php";

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        
        require_once"signup_model.inc.php";
        require_once"signup_contr.inc.php";

        //ERROR HANDLERS
        $errors = [];
        if(isInputEmpty($username, $pwd, $email)){
            $errors["empty_input"] = "Fill in all fields";
        };

        if(isEmailValid($email)){
        $errors["invalid_email"] = "Invalid email";
        };

        if(isUsernameTaken($pdo, $username)){
            $errors["username_taken"] = "Username is taken";
        };

        if(isEmailRegistered($pdo, $username)){
            $errors["email_used"] = "Email is already registered";
        };

        require_once"config_session.inc.php";

        if($errors){
            $_SESSION["error_signup"] = $errors;
            $signupData = [
                "username"=> $username,
                "email" => $email
            ];

            $_SESSION["signup_data"] = $signupData;


            header("location: ../index.php");
            die();
        };

        createUser($pdo, $username, $pwd, $email);
        
        header("location: ../index.php?signup=success");

        $pdo=null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed". $e->getMessage());
    }

}else{
    header("location: ../index.php");
    die();
};