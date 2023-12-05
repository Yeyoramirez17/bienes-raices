<?php 

require 'funciones.php';
require 'config/database.php';

require __DIR__ . '/../vendor/autoload.php';

// Conexióon a la DB
$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB( $db );