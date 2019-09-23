<?php

require_once __DIR__ . '/vendor/autoload.php';

$pdo = new \PDO('mysql:host=localhost;dbname=pdo_library_db', 'root', 'root');
// $pdo = new \App\PDOLib('mysql:host=localhost;dbname=pdo_library_db', 'root', 'root');

// $pdo->createTable('users', [
//   'id' => 'int', 
//   'name' => 'varchar(255)',
//   'from_' => 'varchar(255)',
//   'age' => 'int',
//   ]);
// $pdo->dropTable('users');

// $id = 4;
// $name = 'Robert Mors';
// $from = 'linkedin';
// $age = '21';

// $id = 3;
// $name = 'Paul Smith';
// $name = "Forgery name2'); delete from users; --";

// $sql = "insert into users values({$id}, '{$name}', '{$from}', {$age})";
// $pdo->exec($sql);

// print_r($sql);
// $pdo->exec("insert into users values({$id}, '{$name}')");

// $data = $pdo->query("select * from users")->fetchAll();
// print_r($data);


$query = new \App\PDOQuery($pdo, 'users', []);
$query = $query->where('id', 2);
$query = $query->where('from_', 'github');
$query = $query->where('age', 23);
// $sql = $query->toSql();
// print_r($sql);
// $data = $pdo->query($sql)->fetchAll();
// print_r($data);
// $query->toSql();
// print_r($query->toSql());


$data = $query->all();
var_dump($data);