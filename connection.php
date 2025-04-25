<?php

$domain = "localhost";
$database = "quizwebappdb";
$user = "root";
$pass = "";


try {
    $connection = new PDO("mysql:host=$domain;dbname=$database", $user, $pass);
    echo "Connection established\n";
} catch (PDOException $e){
    echo "Connection failed\n";
}
