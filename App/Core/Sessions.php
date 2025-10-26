<?php  
namespace App\Core;

ini_set("session.use_only_cookies",1);
ini_set("session.uses_strict_mode",1);

class Sessions{
    public static function start(){
        session_set_cookie_params([
            'lifetime' => 1800,
            'domain'=> $_ENV['DB_HOST'], //not sure if correct
            'path' => '/',
            'secure'    => true,
            'httponly'=> true,
        ]);

        if(session_start()===PHP_SESSION_NONE){
            session_start();
        }
    }

    public function checkSession() {
        if (!isset($_SESSION['lastRegeneration'])) {
            $this->regenerateSessionId_loggedIn();
        } else {
            if (!isset($_SESSION['lastRegeneration'])) {
                $this->regenerateSessionId();
            } else {
                $interval = 60*30;
                if(time()-$_SESSION['lastRegeneration']>=$interval){
                    $this->regenerateSessionId();
                }
            }
        }
    }

    public function regenerateSessionId(){
        session_regenerate_id(true);
        $_SESSION['lastRegeneration'] = time();
    }

    public function regenerateSessionId_loggedIn() {
        session_regenerate_id(true);

        $userId = $_SESSION['userId'];
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_". $userId;

        session_id($sessionId);

        $_SESSION['lastRegeneration'] = time();
    }

    public static function sessionLoginErrors($errors){
        if($errors){
            $_SESSION["errorLogin"] = $errors;

            header("location: index.php");
            die();
        }
    }

    public static function newLoginSession($user){
        $newSessionId = session_create_id();
        $sessionId = $newSessionId ."_". $user;
        session_id($sessionId);

        $_SESSION['userId'] = $user["id"];
        $_SESSION['userUsername'] = htmlspecialchars($user["username"]);

        $_SESSION["lastRegeneration"] = time();


    }
}

