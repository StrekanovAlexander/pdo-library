<?php

require_once __DIR__ . '/vendor/autoload.php';

$pdo = new \PDO('mysql:host=localhost;dbname=pdo_library_db', 'root', 'root');

$query = new \App\PDOQuery($pdo, 'users');

$query = $query->where('social', 'github');
$query = $query->select('id', 'name');

// var_dump(sizeof($query->all()));
// var_dump($query->count());

$coll = $query->map(function($row) {
  return $row['id'] . '-' . $row['name'];
});
var_dump($coll);