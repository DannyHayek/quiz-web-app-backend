<?php

include "./connection.php";

$user = $_POST["user"];
$pass = $_POST["pass"];

try {

    $sql = $connection->query("SELECT username FROM users WHERE username = $user");

    $return = $sql->fetch(PDO::FETCH_ASSOC);
    
    if ($return){
        echo "\n$user already exists!";
    } else {
        $sql = $connection->query("INSERT INTO users (username, password) VALUES ($user, $pass)");

        echo "\nUser registered!";
    }
} catch(Throwable $e) {
    echo "Something went wrong!";
}

