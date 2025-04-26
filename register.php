<?php

include "./connection.php";

$user = $_POST["user"];
$pass = $_POST["pass"];

try {

    $query = $connection->prepare("SELECT username FROM users WHERE username = :user");

    $query->bindParam(":user", $user, PDO::PARAM_STR);

    $query->execute();

    $return = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($return){
        echo "\n$user already exists!";
    } else {
        $query = $connection->prepare("INSERT INTO users (username, password) VALUES (:user, :pass)");

        $query->bindParam(":user", $user, PDO::PARAM_STR);
        $query->bindParam(":pass", $pass, PDO::PARAM_STR);

        $query->execute();

        echo "\nUser registered!";
    }
} catch(Throwable $e) {
    echo $e;
}

