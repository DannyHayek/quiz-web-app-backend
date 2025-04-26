<?php

include "./connection.php";

$question_data = $_POST["question_data"];
$question_id = null;

// DELETE FROM questions WHERE question_id = (SELECT question_id FROM questions WHERE question_data = "When was the latest World Cup?");

try {
    //Fetching question id
    $query = $connection->prepare("SELECT question_id FROM questions WHERE question_data = :question_data");

    $query->bindParam(":question_data", $question_data, PDO::PARAM_STR);

    $query->execute();

    $question_id = $query->fetch(PDO::FETCH_ASSOC)["question_id"];
    
    if ($question_id){
        echo "\nQuestion ($question_data) exists! Preparing to delete...";

        // Removing correct answer ID from question
        $query = $connection->prepare("UPDATE questions SET correct_answer_id = null WHERE question_id = :question_id");

        $query->bindParam(":question_id", $question_id, PDO::PARAM_INT);

        $query->execute();

        echo "\nRemoving correct answer ID from question...";

        // Deleting the answers for the question
        $query = $connection->prepare("DELETE FROM answers WHERE question_id = :question_id");

        $query->bindParam(":question_id", $question_id, PDO::PARAM_INT);

        $query->execute();

        echo "\nDeleting answers for question...";

        // Deleting the question
        $query = $connection->prepare("DELETE FROM questions WHERE question_id = :question_id");

        $query->bindParam(":question_id", $question_id, PDO::PARAM_INT);

        $query->execute();

        echo "\nDeleting question...";

        echo "\nQuestion and answers succesfully deleted!";
    } else {
        echo "\nQuestion does not exist! Please select a valid question or create a new one!";
    }
} catch(Throwable $e) {
    echo $e;
}

