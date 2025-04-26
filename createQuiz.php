
<?php

// INSERT INTO quizzes (topic, total_score, quiz_description) VALUES ("Sports", 3, "A Quiz About Sports")


include "./connection.php";

$topic = $_POST["topic"];
$score = $_POST["score"];
$description = $_POST["description"];

try {

    $query = $connection->prepare("SELECT topic FROM quizzes WHERE topic = :topic");

    $query->bindParam(":topic", $topic, PDO::PARAM_STR);

    $query->execute();

    $return = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($return){
        echo "\n$topic quiz already exists!";
    } else {
        $query = $connection->prepare("INSERT INTO quizzes (topic, total_score, quiz_description) VALUES (:topic, :score, :description)");

        $query->bindParam(":topic", $topic, PDO::PARAM_STR);
        $query->bindParam(":score", $score, PDO::PARAM_INT);
        $query->bindParam(":description", $description, PDO::PARAM_STR);

        $query->execute();

        echo "\nQuiz created!";
    }
} catch(Throwable $e) {
    echo $e;
}

