<?php

function setList($intervalsCount) { // Функция для случайных значений исходных интервалов. Принимает необходимое кол-во интервалов
    $result = [];

    for ($i = 0; $i < $intervalsCount; $i++) {
        $interval = random_int(0, 23) . ':' . random_int(0, 59) . '-' . random_int(0, 23) . ':' . random_int(0, 59);
        $result[] = $interval;
    }
    return $result;
}

$list = setList(3);

function isTimeIntervalValid($interval) {                  // Проверка интервала на валидность
    $pattern = '/^([01]\d|2[0-3]):([0-5]\d)-([01]\d|2[0-3]):([0-5]\d)$/';
    return preg_match($pattern, $interval) === 1;
}

function isIntervalOverlap($newInterval) {                  // Проверяем наложения
    global $list;

    foreach ($list as $interval) {
        list($start1, $end1) = explode('-', $interval);     // Разбиваем интервалы на конкретное время
        list($start2, $end2) = explode('-', $newInterval);

        $start1 = strtotime($start1);                       // Приводим к формату времени
        $end1 = strtotime($end1);
        $start2 = strtotime($start2);
        $end2 = strtotime($end2);

        if (($start1 <= $start2 && $start2 <= $end1) || ($start1 <= $end2 && $end2 <= $end1)) {
            return true;                                    // Проверяем наложение
        }
    }

    return false;
}

$newInterval = '14:00-17:00';

// $newInterval = setList(1)[0]; // Тестовый случайный нтервал. Нужно править определение валидности интервала,
                                 // Может иметь значение вроде "4:2-20:1", что не соответствует валидному формату

if (isTimeIntervalValid($newInterval)) {
    if (isIntervalOverlap($newInterval)) {
        echo '<br>Новый интервал = '. $newInterval;
        echo '<br>Интревалы: '. implode(', ', $list);
        echo '<br>Произошло наложение';
    } else {
        echo '<br>Новый интервал - '. $newInterval;
        echo '<br>Интервалы: '. implode(', ', $list);
        echo '<br>Наложения не произошло';
    }
} else {
    echo 'Неверный формат интервала';
}
