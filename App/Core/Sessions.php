<?php  
namespace App\Core;

ini_set("session.use_only_cookies",1);
ini_set("session.uses_strict_mode",1);

class Sessions{
    public static function start(){
        session_set_cookie_params([
            'lifetime' => 1800,
            'domain'=> false, 
            'path' => '/',
            'secure'    => false,
            'httponly'=> true,
            'samesite' => 'Strict'
        ]);

        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['lastRegeneration'])){
            $_SESSION['lastRegeneration'] = time();
        }
    }

    public function checkSession() {
        if (!isset($_SESSION['lastRegeneration'])) {
            self::regenerateSessionId_loggedIn();
        } else {
            if (!isset($_SESSION['lastRegeneration'])) {
                self::regenerateSessionId();
            } else {
                $interval = 60*30;
                if(time()-$_SESSION['lastRegeneration']>=$interval){
                    self::regenerateSessionId();
                }
            }
        }
    }

    public function regenerateSessionId(){
        session_regenerate_id(true);
        $_SESSION['lastRegeneration'] = time();
    }

    public function regenerateSessionId_loggedIn() {
        $userId = $_SESSION['userId'] ?? null;
        session_regenerate_id(true);

        if($userId){
            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_". $userId;
            session_id($sessionId);
        }

        $sessionId['lastRegeneration'] = time();
    }

    public static function sessionLoginErrors($errors){
        if($errors){
            $_SESSION["errorLogin"] = $errors;
        }
    }

    public static function newLoginSession($user){
        session_regenerate_id(true);

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $user['id'];
        session_id($sessionId);

        $_SESSION['userId'] = $user['id'];
        $_SESSION['userUsername'] = htmlspecialchars($user['username'] ?? '');
        $_SESSION['lastRegeneration'] = time();
    }

    public static function sessionSignupErrors($errors, $company, $username){
        if($errors){
            $_SESSION["errorSignup"] = $errors;
            $signupData = [
                "company"=> $company,
                "username"=> $username
            ];

            $_SESSION['signupData'] = $signupData;
        } 
    }

    public function isLoggedIn():bool {
        return isset($_SESSION['user_id']);
    }

    public static function logout(){
        $_SESSION=[];
        if(ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time()-42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
        );
        session_destroy();
        }
    }
}