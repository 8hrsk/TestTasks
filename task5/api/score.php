<?php

$names = $_POST['participants'];

// transform string to array and sort it by first letter of each name (kirillic alphabet)

function generateRandomScore() {
    return rand(1, 100);
}

$names = explode(', ', $names);

sort($names);

foreach ($names as $key => $name) {
    $names[$key] = ['name' => $name, 'score' => generateRandomScore()];
}

// make $names a json

$names = json_encode($names);

echo $names;