<?php

namespace App;

class PDO {
  public static function pdo() {
    return new \PDO('mysql:host=localhost;dbname=pdo_library_db', 'root', 'root');
  }
}