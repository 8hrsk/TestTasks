<?php

class Database {
    private $connection; // Здесь будет хранится соединение

    private $host;
    private $user;
    private $password;
    private $database;

/*

    Здесь я задался вопросом, можно ли сделать 
    private $credentials = [
        'host' => $host,
        'user' => $user,
        'password' => $password,
        'database' => $database
    ];

    и обращаться к $this -> credentials в connect()

*/

    public function __construct($host, $user, $password, $database) { // Конструктор для записи параметров
        $this->host = $host;                                          // при создании нового экземпляра
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

/*

    public function __construct($host, $user, $password, $database) {
        $this->credentials['host'] = $host;
        $this->credentials['user'] = $user;
        $this->credentials['password'] = $password;
        $this->credentials['database'] = $database;
    }

    poblic function connect() {
        return $this->connection = new mysqli($credentials);
    }

    Не уверен, что это вообще может работать

*/

    public function connect() { // Подключаемся
        return $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);     
    }

    public function disconnect() { // Отключаемся 
        return $this->connection->close();
    }

    public function query($query) { // Для запросиков
        return $this->connection->query($query);
    }

    public function escapeString($string) { // Для экранирования
        return $this->connection->real_escape_string($string);
    }

    public function fetchData($data) { // Возвращаем данные
        $result = $data->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}