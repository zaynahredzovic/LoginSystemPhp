<?php   

declare(strict_types= 1);

function isUsernameWrong(bool|array $result){
    if (!$result) {
        return false;
    }else{
        return true;
    };
};

function isPasswordWrong(string $pwd, string $hashedPwd){
    if(!password_verify($pwd, $hashedPwd)){
        return true;
    }else{
        return false;
    };
};