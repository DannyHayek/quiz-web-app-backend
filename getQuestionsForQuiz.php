<?php

include "./connection.php";

$topic = $_POST["topic"];

try {
    // SELECT question_data FROM questions WHERE quiz_id = 2;

    // Fetching the quiz_id based on topic
    $query = $connection->prepare("SELECT quiz_id FROM quizzes WHERE topic = :topic");

    $query->bindParam(":topic", $topic, PDO::PARAM_STR);

    $query->execute();

    $quiz_id = $query->fetch(PDO::FETCH_ASSOC)["quiz_id"];

    echo "\nQuiz ID: $quiz_id\n";

    $questions = array();
    $query = $connection->query("SELECT question_data FROM questions WHERE quiz_id = $quiz_id");

    while($return = $query->fetch(PDO::FETCH_ASSOC)) {
        $questions[] = $return;
    }
    
    echo json_encode($questions);

} catch(Throwable $e) {
    echo $e;
}

