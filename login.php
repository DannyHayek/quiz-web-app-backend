<?php

include "./connection.php";

$user = $_POST["user"];
$pass = $_POST["pass"];
$login = false;

$sql = $connection->query("SELECT * FROM users WHERE username = $user AND password = $pass");

if ($sql != null){
    $return = $sql->fetch(PDO::FETCH_ASSOC);
    echo json_encode($return);
    echo "\nLogged in as $user!";
} else {
    echo "\nThis user does not exist!";
}
