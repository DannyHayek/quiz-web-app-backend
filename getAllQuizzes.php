<?php

include "./connection.php";

try {
    $test = array();
    $query = $connection->query("SELECT * FROM quizzes");

    while($return = $query->fetch(PDO::FETCH_ASSOC)) {
        $test[] = $return;
    }
    
    echo json_encode($test);

} catch(Throwable $e) {
    echo $e;
}

