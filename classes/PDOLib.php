<?php
namespace App;

class PDOLib
{

  private $pdo;

  public function __construct($dsn, $usr = null, $pwd = null)
  {
    $this->pdo = new \PDO($dsn, $usr, $pwd);
  }

  public function createTable($name, array $fields) 
  {
    $str = []; 
    foreach($fields as $key => $value) {
      $str[] = "{$key} {$value}";
    }
    $str = join(', ', $str);
    $this->pdo->exec("create table {$name} ($str)");
    echo "table {$name} was created";
  }

  public function dropTable($name) {
    $this->pdo->exec("drop table {$name}");
    echo "table {$name} was dropped";
  }
  
}