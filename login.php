<?php

include "./connection.php";

$user = $_POST["user"];
$pass = $_POST["pass"];

try {

    $query = $connection->prepare("SELECT * FROM users WHERE username = :user AND password = :pass");

    $query->bindParam(":user", $user, PDO::PARAM_STR);
    $query->bindParam(":pass", $pass, PDO::PARAM_STR);

    $query->execute();

    $return = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($return){
        echo json_encode($return);
        echo "\nLogged in as $user!";
    } else {
        echo "\nThis user does not exist!";
    }
} catch(Throwable $e) {
    echo $e;
}

