<?php

$answers = $_POST["answers"];

$array = explode(",", $answers);

echo json_encode($array);

foreach ($array as $a) {
    echo $a;
}
