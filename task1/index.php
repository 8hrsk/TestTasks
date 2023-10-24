<?php

$areas = array (
    1 => '5-й поселок',
    2 => 'Голиковка',
    3 => 'Древлянка',
    4 => 'Заводская',
    5 => 'Зарека',
    6 => 'Ключевая',
    7 => 'Кукковка',
    8 => 'Новый сайнаволок',
    9 => 'Октябрьский',
    10 => 'Первомайский',
    11 => 'Перевалка',
    12 => 'Сулажгора',
    13 => 'Университетский городок',
    14 => 'Центр',
);


// Близкие районы, связь осуществляется по индентификатору района из массива $areas
$nearby = array (
    1 => array(2,11),	
    2 => array(12,3,6,8),
    3 => array(11,13),    
    4 => array(10,9,13), 
    5 => array(2,6,7,8),   
    6 => array(10,2,7,8),
    7 => array(2,6,8),	
    8 => array(6,2,7,12),	
    9 => array(10,14),     
    10 => array(9,14,12), 
    11 => array(13,1,9),
    12 => array(1,10),     
    13 => array(11,1,8),	
    14 => array(9,10),     
);

$workers = array (
    0 => array (
            'login' => 'login1',
            'area_name' => 'Октябрьский', //9
    ),
    1 => array (
            'login' => 'login2',
            'area_name' => 'Зарека', //5
    ),
    2 => array (
            'login' => 'login3',
            'area_name' => 'Сулажгора', //12
    ),
    3 => array (
            'login' => 'login4',
            'area_name' => 'Древлянка', //3
    ),
    4 => array (
            'login' => 'login5',
            'area_name' => 'Центр', //14
    ),
);

function getAreaKey($area) {
    global $areas;

    return array_search($area, $areas);
}

function getNearAreas($key) {
    global $nearby;

    return $nearby[$key];
}

function checkWorker($key) {
    global $workers, $areas;

    foreach ($workers as $worker) { // проверяем на прямые совпадения
        if ($worker['area_name'] == $areas[$key]) {
            return $worker['login'];
        }
    }
}

function nearAreasSearch($nearArea) {
    global $areas;

    for ($nearIndex = 0; $nearIndex < count($nearArea); $nearIndex++) {
        $nearAreaName = $areas[$nearArea[$nearIndex]];

        if (checkWorker(getAreaKey($nearAreaName))) {
            return '<br>'.checkWorker(getAreaKey($nearAreaName));
        }
    }

    return false;

}

// function getWorkerByArea($area) { //!refactor
//     global $workers, $nearby, $areas;

//     $key = getAreaKey($area);

//     if (!$key) {
//         echo 'Такого раиона нет';
//     } else {
//         echo 'Район ' . $area;

//         if (checkWorker($key)) {
//             return '<br>'.checkWorker($key);
//         }

//         $near = getNearAreas($key);

//         $deeperSearch = nearAreasSearch($near);

//         if ($deeperSearch == false) {

//             for ($nearIndex = 0; $nearIndex < count($near); $nearIndex++) {
                
//                 $nearAreaName = $areas[$near[$nearIndex]];
//                 $key = getAreaKey($nearAreaName);
//                 $near = getNearAreas($key);

//                 return nearAreasSearch($near);
//             }
//         } else {
//             return $deeperSearch;
//         }
//     }
// }

function getWorkerByArea($area) {
    global $workers, $nearby, $areas;

    $key = getAreaKey($area);

    echo 'Район ' . $area;

    if (!$key) {    // проверяем существует ли район 
        echo 'Такого раиона нет';
        return null;
    }

    if (checkWorker($key)) {    // проверяем на прямые совпадения
        return '<br>'.checkWorker($key);
    }

    $near = getNearAreas($key);

    if (NearAreasSearch($near)) {
        return nearAreasSearch($near);
    }

    for ($nearIndex = 0; $nearIndex < count($near); $nearIndex++) {
        $far = getNearAreas($near[$nearIndex]);

        return nearAreasSearch($far);
    }
}

/*
    Я старался, но в один из моментов алгоритм улететает куда-то не туда. Не совсем понимаю, в чём может быть проблема. Хотя, может, так и надо.
    Раньше я никогда не сталкивался с подобными задачами, поэтому первый такой опыт.
*/

function randomArrayElement($array) { // Сделал для проверки
    $key = array_rand($array);
    return $array[$key];
}

echo getWorkerByArea(randomArrayElement($areas));
