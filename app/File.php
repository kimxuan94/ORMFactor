<?php
class File {

//Database connection properties
public $conn;
public $table_name = "fichiers";

public $id;
public $fp;

//Create collaborateur constructor
public function __construct($db) {
  $this->conn = $db;
}

  public function getFile() {
          // $stmt = $conn->prepare("INSERT INTO fichiers ( image ) VALUES ( ? )");
          $query = "INSERT INTO fichiers ( image ) VALUES ( ? )";
          $stmt = $this->conn->prepare($query);

          $stmt->bindParam(1, $fp, PDO::PARAM_LOB);
          $conn->errorInfo();
          $stmt->execute();
      // }
      // catch(PDOException $e)
      // {
      //     'Error : ' .$e->getMessage();
      // }
  }

}
?>
