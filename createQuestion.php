<?php

// INSERT INTO questions (question_data, quiz_id) VALUES ("When was the most recent World Cup?", 6);
// INSERT INTO answers (answer, question_id) VALUES (2022, (SELECT question_id FROM questions WHERE question_data = "When was the most recent World Cup?")), (2020, (SELECT question_id FROM questions WHERE question_data = "When was the most recent World Cup?")), (2018, (SELECT question_id FROM questions WHERE question_data = "When was the most recent World Cup?")), (2016, (SELECT question_id FROM questions WHERE question_data = "When was the most recent World Cup?"));
// UPDATE questions SET correct_answer_id = (SELECT answer_id FROM answers WHERE answer = 2022) WHERE question_id = (SELECT question_id FROM questions WHERE question_data = "When was the most recent World Cup?");


include "./connection.php";

$topic = $_POST["topic"];
$quiz_id = null;

$question_data = $_POST["question_data"];
$question_id = null;

$answers = explode(",", $_POST["answers"]);  // Takes as many answers are needed divided by commas, then explodes them into an array to be used later
$correct = $_POST["correct"];


try {

    $query = $connection->prepare("SELECT quiz_id FROM quizzes WHERE topic = :topic");

    $query->bindParam(":topic", $topic, PDO::PARAM_STR);

    $query->execute();

    $quiz_id = $query->fetch(PDO::FETCH_ASSOC)["quiz_id"];
    
    if ($quiz_id){
        echo "\n$topic quiz exists! Quiz ID: $quiz_id.";

        $query = $connection->prepare("SELECT question_id FROM questions WHERE question_data = :question_data");

        $query->bindParam(":question_data", $question_data, PDO::PARAM_STR);

        $query->execute();

        $return = $query->fetch(PDO::FETCH_ASSOC);

        if ($return) {
            echo "\nQuestion ($question_data) already exists!";
        } else {
            echo "\nQuestion does not exist! Creating question...";

            $query = $connection->prepare("INSERT INTO questions (question_data, quiz_id) VALUES (:question_data, :quiz_id)");

            $query->bindParam(":question_data", $question_data, PDO::PARAM_STR);
            $query->bindParam(":quiz_id", $quiz_id, PDO::PARAM_INT);

            $query->execute();

        }

    } else {
        echo "\nQuiz does not exist! Please select a valid quiz or create a new one!";
    }
} catch(Throwable $e) {
    echo $e;
}

