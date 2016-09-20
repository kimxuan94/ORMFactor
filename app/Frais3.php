<?php

class Frais {

  //Database connection property object and table name property
  private $conn;
  private $table_name = "frais";

  //Create object properties of collaborateurs
  public $id;
  public $no_poste;
  public $reparation;
  public $gardiennage;
  public $remplacement;
  public $remise_neuf;
  public $date_facturation;
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

      $stmt->bindParam(1, $this->id);
      $stmt->bindParam(2, $this->no_poste);
      $stmt->bindParam(3, $this->reparation);
      $stmt->bindParam(4, $this->gardiennage);
      $stmt->bindParam(5, $this->remplacement);
      $stmt->bindParam(6, $this->remise_neuf);
      $stmt->bindParam(7, $this->commentaire);
      $stmt->bindParam(8, $this->date_facturation);


      if($stmt->execute()) {
        return true;
      } else {
        return false;
      }
  }

  /**READ collaborateur**/
  function readAll($page, $from_record_num, $records_per_page) {

      $query = "SELECT *,
        DATE_FORMAT(date_facturation, '%d/%m/%Y') as date_facturation
       FROM " . $this->table_name . " ORDER BY id ASC LIMIT {$from_record_num}, {$records_per_page}";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
  }

  /**PAGINATION for frais**/
    public function countAll(){

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

  /**READ frais by ID after update**/
    function readFraisID(){

        // $query = "SELECT * FROM  " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $query = "SELECT *,
                      DATE_FORMAT(date_facturation, '%d/%m/%Y') as date_facturation
         FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->no_poste = $row['numero_poste'];
        $this->reparation = $row['montant_reparation'];
        $this->gardiennage = $row['montant_gardiennage'];
        $this->remplacement = $row['montant_remplacement'];
        $this->remise_neuf = $row['montant_remise_neuf'];
        $this->date_facturation = $row['date_facturation'];
        $this->commentaire = $row['commentaire'];
    }

    /**UPDATE for frais**/
    function updateFrais(){
      $query = "UPDATE " . $this->table_name . "
      SET
        id = :id,
        numero_poste = :poste,
        montant_reparation = :reparation,
        montant_gardiennage = :gardiennage,
        montant_remplacement = :remplacement,
        montant_remise_neuf = :neuf,
        date_facturation = :facturation,
        commentaire = :com
     WHERE
       id = :id";

     $stmt = $this->conn->prepare($query);

     $stmt->bindParam(':id', $this->id);
     $stmt->bindParam(':poste', $this->no_poste);
     $stmt->bindParam(':reparation', $this->reparation);
     $stmt->bindParam(':gardiennage', $this->gardiennage);
     $stmt->bindParam(':remplacement', $this->remplacement);
     $stmt->bindParam(':neuf', $this->remise_neuf);
     $stmt->bindParam(':facturation', $this->date_facturation);
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

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

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
