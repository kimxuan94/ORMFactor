<?php

class Database
{
  //Config properties
  private $host = "localhost";
  private $db_name = "biocodex_orm";
  private $user = "usedev";
  private $password = "";
  private $conn;

  //Allow to get connection from database
  public function getConnection()
  {
    //pdo is our object connection
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

    } catch(PDOException $exception) {
      echo "Erreur de connexion avec la base de données". $exception->getMessage();
    }
    return $this->conn;
  }
}
?>
