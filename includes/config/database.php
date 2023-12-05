<?php

function conectarDB(): mysqli {
    $db = new mysqli('localhost', 'root', '', 'db_bienes_raices');

    if(!$db) {
        echo 'No se conectó';
        exit;
    }

    return $db;
}