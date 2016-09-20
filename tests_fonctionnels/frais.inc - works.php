<?php

class Frais {

  //Database connection property object and table name property
  private $conn;
  private $table_name = "Frais";

  //Create object properties of collaborateurs
  public $poste_frais;
  public $reparation;
  public $gardiennage;
  public $remplacement;
  public $remise_neuf;
  public $supp_pneu;
  public $facturation;
  public $commentaire;

  //Create frais constructor
  public function __construct($db) {
    $this->conn = $db;
  }

  /**CREATE frais**/
  function createFrais() {

      //Create query
      $query = "INSERT INTO " . $this->table_name . " values(?,?,?,?,?,?,?,?)";

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->poste_frais);
      $stmt->bindParam(2, $this->reparation);
      $stmt->bindParam(3, $this->gardiennage);
      $stmt->bindParam(4, $this->remplacement);
      $stmt->bindParam(5, $this->remise_neuf);
      $stmt->bindParam(6, $this->supp_pneu);
      $stmt->bindValue(7, $this->facturation);
      $stmt->bindParam(8, $this->commentaire);

      if($stmt->execute()) {
        return true;
      } else {
        return false;
      }
  }

  /**READ collaborateur**/
  function readAll($page, $from_record_num, $records_per_page) {

      $query = "SELECT *
        -- DATE_FORMAT(date_facturation, 'Y-m-d H:i:s',timestamp) as date_facturation,
       FROM " . $this->table_name . " ORDER BY poste_frais ASC LIMIT {$from_record_num}, {$records_per_page}";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
  }

  /**PAGINATION for frais**/
    public function countAll(){

        $query = "SELECT poste_frais FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

  /**READ frais by ID after update**/
    function readFraisID(){

        $query = "SELECT * FROM  " . $this->table_name . " WHERE poste_frais = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->poste_frais = $row['poste_frais'];
        $this->reparation = $row['reparation'];
        $this->gardiennage = $row['gardiennage'];
        $this->remplacement = $row['remplacement'];
        $this->remise_neuf = $row['remise_neuf'];
        $this->supp_pneu = $row['supp_pneu'];
        $this->facturation = $row['date_facturation'];
        $this->commentaire = $row['commentaire'];
    }

    /**UPDATE for frais**/
    function updateFrais(){
      $query = "UPDATE " . $this->table_name . "
      SET
        poste_frais = :pf,
        reparation = :rep,
        gardiennage = :gar,
        remplacement = :rem,
        remise_neuf = :neu,
        supp_pneu = :sup,
        date_facturation = :fac,
        commentaire = :com
     WHERE
       poste_frais = :pf";

     $stmt = $this->conn->prepare($query);

     $stmt->bindParam(':pf', $this->poste_frais);
     $stmt->bindParam(':rep', $this->reparation);
     $stmt->bindParam(':gar', $this->gardiennage);
     $stmt->bindParam(':rem', $this->remplacement);
     $stmt->bindParam(':neu', $this->remise_neuf);
     $stmt->bindParam(':sup', $this->supp_pneu);
     $stmt->bindParam(':fac', $this->facturation);
     $stmt->bindParam(':com', $this->commentaire);

     //Execute update query
     if ($stmt->execute()) {
       return true;
     } else {
        return false;
     }
    }

    /**DELETE frais by ID**/
    function deleteFrais()
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE poste_frais = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
