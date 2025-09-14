<?php

declare(strict_types= 1);


function getUsername(object $pdo, string $username){
    $query = "SELECT username from users where username=?;";
    
    $stmt= $pdo->prepare($query);
    $stmt->execute([$username]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getEmail(object $pdo, string $email) {
    $query = "SELECT email from users where email=?;";
    
    $stmt= $pdo->prepare($query);
    $stmt->execute([$email]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function setUser(object $pdo, string $username, string $pwd,string $email){
    $query = "INSERT INTO users (username, pwd, email) values (?,?,?);";
    
    $stmt= $pdo->prepare($query);

    $options = [
        'cost' => 12,
    ];

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->execute([$username, $hashedPwd, $email]);


}