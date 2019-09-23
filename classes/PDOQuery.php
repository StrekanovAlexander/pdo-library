<?php
namespace App;

class PDOQuery 
{
  private $pdo;
  private $table;
  private $where;

  public function __construct($pdo, $table, $where = [])
  {
    $this->pdo = $pdo;
    $this->table = $table;
    $this->where = $where;
  }

  private function getClone($where) {
    $mergedData = array_merge($this->where, $where);
    return new self($this->pdo, $this->table, $mergedData);
  }

  public function where($key, $value) {
    $where = [$key => $value];
    return $this->getClone($where);
  }

  public function toSql() {

    $sql = "select * from {$this->table}";
    if (!empty($this->where)) {
      $data = [];
      foreach ($this->where as $key => $value) {
        $data[] = "{$key} = {$this->pdo->quote($value)}"; 
      }
      $data = join(' AND ', $data);
      $sql .= " where " . $data;
    } 
    return $sql;
  }

  public function all()
  {
    return $this->pdo->query($this->toSql())->fetchAll();
  }

} 