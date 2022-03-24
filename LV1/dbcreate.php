<?php

function createTable(){
    $pdo = new PDO('mysql:dbname=radovi;host=localhost', 'root', '');

    $sql = "CREATE TABLE IF NOT EXISTS `diplomski_radovi` (
        `id` int(11) PRIMARY KEY AUTO_INCREMENT,
        `naziv_rada` varchar(128) NOT NULL,
        `tekst_rada` varchar(3000) NOT NULL,
        `link_rada` varchar(256) NOT NULL,
        `oib_tvrtke` varchar(13) NOT NULL
        ) ENGINE=InnoDB ;";

    $pdo->exec($sql);

    $pdo = null;
    unset($pdo);
}