<?php
require_once __DIR__ . '/vendor/autoload.php';

$pdo = \App\PDO::pdo();

// function like($pdo, array $params) {
//   $sql = 'SELECT id FROM users';
//   if (!$params) {
//     $stmt = $pdo->query($sql); 
//     $stmt->execute(); 
//   } else {
//     $fields = array_map(function ($field) {
//       return "{$field} LIKE ?";
//     }, array_keys($params));
//     $sql .= ' WHERE ' . join(' OR ', $fields);
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute(array_values($params));
//   }
//   return $stmt->fetchAll(PDO::FETCH_COLUMN);
  
// }

// $params = ['name' => '%Paul%', 'social' => 'ya%'];
// $result = like($pdo, $params);

// $result = like($pdo, []);

// print_r($result);

// if (empty($params)) {
  //   $stmt = $pdo->query('SELECT id FROM users'); 
  //   $stmt->execute(); 
  // } else {
    // $name1 = '%Paul%';
    // $name2 = 'ya%';
    // $stmt = $pdo->prepare('SELECT id FROM users WHERE name LIKE ? OR social LIKE ?');
    // $stmt->execute([$name1, $name2]);
    //return $stmt->fetchAll(PDO::FETCH_COLUMN);
  // }  

// echo "In operator";
// echo "<br>";
// $idx = [1, 3, 4];
// $in = implode(", ", array_fill(0, sizeof($idx), '?'));
// $sql = "SELECT name FROM users WHERE id IN ($in)";
// $stmt = $pdo->prepare($sql);
// $stmt->execute($idx);
// print_r($stmt->fetchAll(\PDO::FETCH_ASSOC));
  

echo "where with sort <br>";

function where($pdo, array $params = []) {
  $sql = "SELECT id FROM users";
  $where = [];
  foreach ($params as $key => $value) {
    $where[] = "{$key} IN ({$value})";
  }
  $where = " WHERE " . implode(" OR ", $where);
  
  return $sql . $where;
}

$result = where($pdo, ['name' => 'Paul Smith', 'social' => 'github']);
print_r($result);
