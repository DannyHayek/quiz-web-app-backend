<?php

include "./connection.php";

$quizID = $_POST["quizID"];
$topic = $_POST["topic"];
$score = $_POST["score"];
$description = $_POST["description"];

try {

    $query = $connection->prepare("SELECT topic FROM quizzes WHERE quiz_id = :quizID");

    $query->bindParam(":quizID", $quizID, PDO::PARAM_INT);

    $query->execute();

    $return = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($return){
        $query = $connection->prepare("UPDATE quizzes SET quiz_description = :description, topic = :topic, total_score = :score WHERE quiz_id = :quizID");

        // UPDATE quizzes SET quiz_description = "A quiz about sports", topic = "World Sports" WHERE quiz_id = 6;

        $query->bindParam(":quizID", $quizID, PDO::PARAM_INT);
        $query->bindParam(":topic", $topic, PDO::PARAM_STR);
        $query->bindParam(":score", $score, PDO::PARAM_INT);
        $query->bindParam(":description", $description, PDO::PARAM_STR);

        $query->execute();

        echo "\nQuiz updated!";
        
    } else {
        echo "\n$topic quiz does not exist!";
    }
} catch(Throwable $e) {
    echo $e;
}

