<?php

require_once __DIR__ . '/vendor/autoload.php';

$pdo = new \App\PDOLib('mysql:host=localhost;dbname=pdo_library_db', 'root', 'root');

$pdo->createTable('users', ['id' => 'int', 'name' => 'varchar(255)']);
// $pdo->dropTable('users');
