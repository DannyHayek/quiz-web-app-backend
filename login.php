<?php

include "./connection.php";

$user = $_POST["user"];
$pass = $_POST["pass"];

try {

    $sql = $connection->query("SELECT * FROM users WHERE username = $user AND password = $pass");

    $return = $sql->fetch(PDO::FETCH_ASSOC);
    
    if ($return){
        echo json_encode($return);
        echo "\nLogged in as $user!";
    } else {
        echo "\nThis user does not exist!";
    }
} catch(Exception $e) {
    echo "Something went wrong!";
}

