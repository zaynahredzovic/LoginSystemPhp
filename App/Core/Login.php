<?php
namespace App\Core;
use App\Controllers\LoginController;
use App\Models\LoginModel;
use LogicException;

class Login{
    private string $username;
    private string $password;

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
        $errors = [];
        
        $loginModel = new LoginModel();
        if($loginModel->isInputEmpty($this->username, $this->password)){
            $errors["empty_input"] = "Fill in all fields";
        }

        $user = $loginModel->getUser($this->username, $this->password);
        
        $loginController = new LoginController();
        if($loginController->isUsernameWrong($user)){
            $errors["empty_input"]= "Incorrect login info!";
        }

        if(!$loginController->isUsernameWrong($user) && $loginController->isPasswordWrong($user)){
            $errors["empty_input"]= "Incorrect login info!";
        }
    }

    /* figure out where this goes
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
    */

}
