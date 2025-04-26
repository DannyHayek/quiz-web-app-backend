<?php

include "./connection.php";

$newTopic = null;

$topic = $_POST["topic"];
$newTopic = $_POST["newTopic"];
$score = $_POST["score"];
$description = $_POST["description"];

try {

    $query = $connection->prepare("SELECT topic FROM quizzes WHERE topic = :topic");

    $query->bindParam(":topic", $topic, PDO::PARAM_STR);

    $query->execute();

    $return = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($return){
        if ($newTopic == null) {
            $query = $connection->prepare("UPDATE quizzes SET quiz_description = :description, topic = :topic, total_score = :score WHERE topic = :topic");

            $query->bindParam(":topic", $topic, PDO::PARAM_STR);
            $query->bindParam(":score", $score, PDO::PARAM_INT);
            $query->bindParam(":description", $description, PDO::PARAM_STR);
    
            $query->execute();
        } else {
            $query = $connection->prepare("UPDATE quizzes SET quiz_description = :description, topic = :newTopic, total_score = :score WHERE topic = :topic");

            $query->bindParam(":topic", $topic, PDO::PARAM_STR);
            $query->bindParam(":newTopic", $newTopic, PDO::PARAM_STR);
            $query->bindParam(":score", $score, PDO::PARAM_INT);
            $query->bindParam(":description", $description, PDO::PARAM_STR);

            $query->execute();
        }
        
        echo "\nQuiz updated!";
        
    } else {
        echo "\n$topic quiz does not exist!";
    }
} catch(Throwable $e) {
    echo $e;
}

