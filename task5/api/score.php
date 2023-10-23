<?php

$names = $_POST['participants']; // получаем данные

function generateRandomScore() {
    return rand(1, 100);
}

$names = explode(', ', $names); // делаем массив из строки

sort($names); // сортирую его

foreach ($names as $key => $name) {
    $names[$key] = ['name' => $name, 'score' => generateRandomScore()];
}

// Передаю данные братно в виде json
$names = json_encode($names);

echo $names;