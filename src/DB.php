<?php
namespace Rrd108\SlimPhpApi;

use PDO;

class DB {
  private $host = 'localhost';
  private $db = 'slim-php-api';
  private $user = 'root';
  private $pass = 123;

  public function connect() {
    return new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass);
  }
}