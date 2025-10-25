<?php   

declare(strict_types= 1);

function isInputEmpty(string $username, string $pwd){
    if(empty($username) || empty($pwd)){
        return true;
    }else{
        return false;
    };
};

function getUser(object $pdo, string $username){
    $query = "SELECT * from users where username=?;";
    
    $stmt= $pdo->prepare($query);
    $stmt->execute([$username]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
};

