<?php

// UPDATE questions SET question_data = "When was the latest World Cup?" WHERE question_id = (SELECT question_id FROM questions WHERE question_data = "When was the most recent World Cup?");

include "./connection.php";


$question_data = $_POST["question_data"];
$new_question = $_POST["new_question"];


try {

    $query = $connection->prepare("SELECT question_id FROM questions WHERE question_data = :question_data");

    $query->bindParam(":question_data", $question_data, PDO::PARAM_STR);

    $query->execute();

    $question_id = $query->fetch(PDO::FETCH_ASSOC)["question_id"];
    
    if ($question_id){
        $query = $connection->prepare("UPDATE questions SET question_data = :new_question WHERE question_id = $question_id");

        $query->bindParam(":new_question", $new_question, PDO::PARAM_STR);

        $query->execute();

        echo "\nQuestion updated!";
    } else {
        echo "\nQuestion ($question_data) does not exist! Please create it first or select a different question!";
    }
} catch(Throwable $e) {
    echo $e;
}

