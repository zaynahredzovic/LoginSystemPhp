<?php
namespace App\Views;


use App\Core\Sessions;

class LoginView{
    private array $errors;

    public function __construct(){
        $errors = $this->errors;
    }

    public function checkLoginErrors(){
        if(isset($_SESSION['errorLogin'])){
            $errors = $_SESSION['errorLogin'];
            
            echo "<br>";

            foreach ($errors as $error) {
            echo '<p class="form-error>"'.$error."</p><br>";
            }

            unset($_SESSION['errorLogin']);
        }elseif (isset($_GET['login']) && $_GET['login']==='success') {
            echo "<br>";
            echo '<p class="form-success"> Login success! </p>';
    }
    }
}
