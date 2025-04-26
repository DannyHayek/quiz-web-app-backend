<?php

include "./connection.php";

$topic = $_POST["topic"];

try {

    $query = $connection->prepare("SELECT topic FROM quizzes WHERE topic = :topic");

    $query->bindParam(":topic", $topic, PDO::PARAM_STR);

    $query->execute();

    $return = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($return){
        $query = $connection->prepare("DELETE FROM quizzes WHERE topic = :topic");

        $query->bindParam(":topic", $topic, PDO::PARAM_STR);

        $query->execute();

        echo "\nQuiz deleted!";
        
    } else {
        echo "\n$topic quiz does not exist!";
    }
} catch(Throwable $e) {
    echo $e;
}

