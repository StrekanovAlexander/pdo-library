<?php
require_once __DIR__ . '/vendor/autoload.php';

$pdo = \App\PDO::pdo();

$result = where($pdo, []);
print_r($result);


/*
where($pdo, []); // select id from users order by id
where($pdo, ['id' => []]); // select id from users order by id

// select id from users where first_name in ('john', 'adel') order by id
where($pdo, ['first_name' => ['john', 'adel']])

// select id from users where first_name = 'ada' or source in ('bing', 'gmail') order by id
where($pdo, ['first_name' => 'ada', 'source' => ['bing', 'gmail']])

[['1', '3', '8', '9'], []],
[['1', '3', '8', '9'], ['id' => []]],
[['1', '3'], ['first_name' => ['john', 'adel']]],
[['3', '8', '9'], ['first_name' => 'ada', 'source' => ['bing', 'gmail']]],
[['3'], ['first_name' => 'adel']],
[['1', '3', '9'], ['first_name' => ['ada', 'john'], 'source' => ['gmail', 'yandex']]],

*/
