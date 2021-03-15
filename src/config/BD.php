<?php

class BD {
  private $host = 'localhost';
  private $user = 'root';
  private $pass = '123456';
  private $nombreBD = 'slimFramework';

  // Conección
  public function coneccionBD() {
    $mysqlConn = "mysql:host=$this->host;dbname=$this->nombreBD";
    $dbConn = new PDO($mysqlConn, $this->user, $this->pass);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConn;
  }
}
