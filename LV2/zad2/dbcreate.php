<?php

function createTable(){
    $pdo = new PDO('mysql:dbname=encrypt;host=localhost', 'root', '');

    $sql = "CREATE TABLE IF NOT EXISTS `documents` (
        `id` int(11) PRIMARY KEY AUTO_INCREMENT,
        `name` varchar(128) NOT NULL UNIQUE,
        `iv` varchar(128) NOT NULL
        ) ENGINE=InnoDB ;";

    $pdo->exec($sql);

    $pdo = null;
    unset($pdo);
}