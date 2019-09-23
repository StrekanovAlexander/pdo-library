<?php
namespace App;

interface PDOLibInterface
{
  public function __construct($dsn, $usr = null, $pwd = null);
  public function createTable($name, array $fields);
  public function dropTable($name);
}