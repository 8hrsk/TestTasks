<?php

/* 
    использую phpmyadmin для работы с MySQL. Базы данныз создаю с помощью приложенных SQL запросов,
    вставляя из в специальный инструмент phpmyadmin для SQL-запросов.

    Конечно, я могу бы использовать $db -> query('...'); для добавления всех записей,
    но мне было удобнее сделать всё поочередно через админку
*/

require './Database.php';

$db = new Database('localhost', 'root', '', 'shop');
$db -> connect();

//! Вывести подьзователей, который хотя бы раз совершали заказы

$atLEastOneORder = $db->query('
    SELECT DISTINCT users.* FROM users JOIN orders ON users.id = orders.user_id
');
$atLEastOneORder = $db -> fetchData($atLEastOneORder);

echo 'Пользователи с как минимум одним заказом: <br>';
foreach ($atLEastOneORder as $user) {
    echo $user['name'] . '<br>';
}

//! Соответствие товаров и каталогов

echo '<br><br>Товары и каталог: <br>';

$catalogs = $db -> query('
    SELECT p.*, c.name AS catalog_name
    FROM products p
    JOIN catalogs c ON p.catalog_id = c.id;
');

$resultCatalogs = $db -> fetchData($catalogs);

foreach ($resultCatalogs as $Item) {
    echo $Item['name'] . ' - ' . $Item['catalog_name'] . '<br>';
}

//! Транзакция записи id = 1 

$result = $db -> query('
    START TRANSACTION;
    
    INSERT INTO sample.users
    SELECT * FROM shop.users WHERE id = 1;
    
    DELETE FROM shop.users WHERE id = 1;
    
    COMMIT;
'); // Как я ни пытался, не смог составить транзакцию. Видимо, что-то я не поинмаю. Скорее всего, у меня включен autocommit в config'е

//! Случайный пользователь старше 30 лет и с минимум тремя заказами

echo '<br><br>Случайный пользователь старше 30 лет и с минимум тремя заказами: <br>';

/*
    Тут случился конфуз, изначально в таблице всего три пользователя. Все они не подходят по параметрам.
    Как я понимаю, после четвертого пункта должен быть ещё один запрос для бд с этими пользователями,
    но он не сохранился во время написния задания. (В самом тз после 4 пункта идеть запись 'USE shop;', но потом пусто)
    Я добавил пользователей со случайными данными, которые подходят по условию.
*/

/*
Добавил юзеров:
    $db -> query("
    INSERT INTO users VALUES
        (DEFAULT, 'Ruslan82', '1982-10-10', NOW(), NOW()),
        (DEFAULT, 'Vladimir', '2003-05-09', NOW(), NOW()),
        (DEFAULT, 'Danil', '1980-05-17', NOW(), NOW()),
        (DEFAULT, 'Roman Tier30 Pudge', '1990-04-15', NOW(), NOW()),
        (DEFAULT, 'Prosto Smotry', '1993-01-01', NOW(), NOW()),
        (DEFAULT, 'Ira5', '1985-07-19', NOW(), NOW());
    ");

Добавил заказы:
    $db -> query("
    INSERT INTO orders VALUES
        (DEFAULT, 2, DEFAULT, DEFAULT),
        (DEFAULT, 2, DEFAULT, DEFAULT),
        (DEFAULT, 5, DEFAULT, DEFAULT),
        (DEFAULT, 8, DEFAULT, DEFAULT),
        (DEFAULT, 8, DEFAULT, DEFAULT),
        (DEFAULT, 8, DEFAULT, DEFAULT),
        (DEFAULT, 8, DEFAULT, DEFAULT),
        (DEFAULT, 8, DEFAULT, DEFAULT),
        (DEFAULT, 5, DEFAULT, DEFAULT),
        (DEFAULT, 10, DEFAULT, DEFAULT),
        (DEFAULT, 7, DEFAULT, DEFAULT),
        (DEFAULT, 7, DEFAULT, DEFAULT),
        (DEFAULT, 10, DEFAULT, DEFAULT);
    ");
*/

$ranUser = $db -> query('
    SELECT u.*
    FROM users u
    JOIN orders o ON u.id = o.user_id
    WHERE u.birthday_at <= DATE_SUB(NOW(), INTERVAL 30 YEAR)
    GROUP BY u.id
    HAVING COUNT(o.id) >= 3
    ORDER BY RAND()
    LIMIT 1;
');

$ranUser = $db -> fetchData($ranUser);

foreach ($ranUser as $user) {
    echo 'Name: ' . $user['name'] . ';<br>Birthday: ' .  $user['birthday_at'] . '<br>';
}

$db->disconnect();
