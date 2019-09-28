<?php
require_once __DIR__ . '/vendor/autoload.php';

$pdo = \App\PDO::pdo();

function where($pdo, array $params) {

  $sql = "SELECT id FROM users";
  $orderBy = "ORDER BY id";

  if (!$params) {
    $stmt = $pdo->query("{$sql} {$orderBy}");
    return $stmt->fetchAll(\PDO::FETCH_COLUMN);
  } 
    
  $where = [];
  $exec = [];

  foreach ($params as $key => $value) {
    if (!is_array($value) && $value) {
      $where[] = "{$key} = ?";
      $exec[] = $value;
    } else {
      if ($value) {
        $in = implode(", ", array_fill(0, sizeof($value), "?"));
        $where[] = "{$key} IN ({$in})";
        $exec = array_merge($exec, array_values($value));
      }
    }
  }
  $where = $where ? "WHERE " . implode(" OR ", $where) : "";
  $stmt = $pdo->prepare("{$sql} {$where} {$orderBy}");
  $stmt->execute($exec);

  return $stmt->fetchAll(\PDO::FETCH_COLUMN);
}

$result = where($pdo, ['name' => ['john', 'adel']]);
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
