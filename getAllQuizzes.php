<?php

include "./connection.php";

try {
    $test = array();
    $sql = $connection->query("SELECT * FROM quizzes");

    while($return = $sql->fetch(PDO::FETCH_ASSOC)) {
        $test[] = $return;
    }
    
    echo json_encode($test);

} catch(Throwable $e) {
    echo $e;
}

