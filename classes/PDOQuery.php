<?php
namespace App;

class PDOQuery 
{
  private $pdo;
  private $table;
  private $data = [
    'select' => '*',
    'where' => [],
  ];

  public function __construct($pdo, $table, $data = null)
  {
    $this->pdo = $pdo;
    $this->table = $table;
    if ($data) {
      $this->data = $data;
    }
  }

  public function where($key, $value)
  {
    $data = ['where' => array_merge($this->data['where'], [$key => $value])];
    return $this->getClone($data);
  }

  private function getClone($data)
  {
    $mergedData = array_merge($this->data, $data);
    return new self($this->pdo, $this->table, $mergedData);
  }

  public function select(...$arguments)
  {
    $select = implode(', ', $arguments);
    return $this->getClone(['select' => $select]);
  }

  private function buildWhere()
  {
    return implode(' AND ', array_map(function ($key, $value) {
      $quotedValue = $this->pdo->quote($value);
        return "$key = $quotedValue";
      }, array_keys($this->data['where']), $this->data['where']));
  }

  public function toSql()
  {
    $sqlParts = [];
    $sqlParts[] = "SELECT {$this->data['select']} FROM {$this->table}";
    if ($this->data['where']) {
      $where = $this->buildWhere();
      $sqlParts[] = "WHERE $where";
    }
    return implode(' ', $sqlParts);
  }  

  public function all()
  {
    return $this->pdo->query($this->toSql())->fetchAll();
  }

  public function count()
  {
    $sql = "select count(*) from $this->table";
    if ($this->data['where']) {
      $where = $this->buildWhere();
      $sql .= " WHERE $where";
    }
    return $this->pdo->query($sql)->fetchColumn();
  }
} 