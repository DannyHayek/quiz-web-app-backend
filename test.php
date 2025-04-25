<?php

$user = $_GET["user"];
$pass = $_GET["pass"];

$array = [
    "user" => $user,
    "pass" => $pass,
];

echo json_encode($array);
