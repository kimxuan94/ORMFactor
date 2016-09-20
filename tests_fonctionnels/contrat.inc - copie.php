<?php

class Contrat {

  //Database connection property object and table name property
  private $conn;
  private $table_name = "contrats";

  //Create object properties of collaborateurs
  public $no_contrat;
  public $idimmatveh;
  public $idmatrh;
  public $collaborateurs;
  public $vehicules;
  public $debut_contrat;
  public $fin_contrat;
  public $val_franchise;
  public $nbaccidents;
  public $pfranchise;
  public $sfranchise;
  public $tfranchise;
  public $qfranchise;
  public $commentaire;

  //Create contrat constructor
  public function __construct($db) {
    $this->conn = $db;
  }

  /**CREATE contrat**/
  function createContrat() {

      //Create query
      $query = "INSERT INTO " . $this->table_name . " values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->no_contrat);
      $stmt->bindParam(2, $this->idimmatveh);
      $stmt->bindParam(3, $this->idmatrh);
      $stmt->bindParam(4, $this->collaborateurs);
      $stmt->bindParam(5, $this->vehicules);
      $stmt->bindParam(6, $this->debut_contrat);
      $stmt->bindParam(7, $this->fin_contrat);
      $stmt->bindParam(8, $this->val_franchise);
      $stmt->bindParam(9, $this->nbaccidents);
      $stmt->bindParam(10, $this->pfranchise);
      $stmt->bindParam(11, $this->sfranchise);
      $stmt->bindParam(12, $this->tfranchise);
      $stmt->bindParam(13, $this->qfranchise);
      $stmt->bindParam(14, $this->commentaire);

      if($stmt->execute()) {
        return true;
      } else {
        return false;
      }
  }

  /**READ collaborateur**/
  function readAll($page, $from_record_num, $records_per_page) {

      $query = "SELECT * FROM " . $this->table_name . " ORDER BY no_contrat ASC LIMIT {$from_record_num}, {$records_per_page}";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
  }

  /**PAGINATION for contrat**/
    public function countAll(){

        $query = "SELECT no_contrat FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

  /**READ contrat by ID after update**/
    function readContratID(){

        $query = "SELECT * FROM  " . $this->table_name . " WHERE no_contrat = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->no_contrat = $row['no_contrat'];
        $this->idimmatveh = $row['id_immatveh'];
        $this->idmatrh = $row['id_matrh'];
        $this->collaborateurs = $row['list_collab'];
        $this->vehicules = $row['list_vehicules'];
        $this->debut_contrat = $row['debut_contrat'];
        $this->fin_contrat = $row['fin_contrat'];
        $this->val_franchise = $row['val_franchise'];
        $this->nbaccidents = $row['nb_accidents'];
        $this->pfranchise = $row['fran_accident1'];
        $this->sfranchise = $row['fran_accident2'];
        $this->tfranchise = $row['fran_accident3'];
        $this->qfranchise = $row['fran_accident4'];
        $this->commentaire = $row['commentaire'];

    }

    /**UPDATE for contrat**/
    function updateContrat(){
      $query = "UPDATE " . $this->table_name . "
      SET
        id_immatveh = :immatveh,
        id_matrh = :matrh,
        list_collab = :lcol,
        list_vehicules = :lveh,
        debut_contrat = :deb,
        fin_contrat = :fin,
        val_franchise = :vfra,
        nb_accidents = :nbacc,
        fran_accident1 = :fr1,
        fran_accident2 = :fr2,
        fran_accident3 = :fr3,
        fran_accident4 = :fr4,
        commentaire = :com

     WHERE
       no_contrat = :nocontrat";

     $stmt = $this->conn->prepare($query);

     $stmt->bindParam(':immatveh', $this->idimmatveh);
     $stmt->bindParam(':matrh', $this->idmatrh);
     $stmt->bindParam(':lcol', $this->collaborateurs);
     $stmt->bindParam(':lveh', $this->vehicules);
     $stmt->bindParam(':deb', $this->debut_contrat);
     $stmt->bindParam(':fin', $this->fin_contrat);
     $stmt->bindParam(':vfra', $this->val_franchise);
     $stmt->bindParam(':nbacc', $this->nbaccidents);
     $stmt->bindParam(':fr1', $this->pfranchise);
     $stmt->bindParam(':fr2', $this->sfranchise);
     $stmt->bindParam(':fr3', $this->tfranchise);
     $stmt->bindParam(':fr4', $this->qfranchise);
     $stmt->bindParam(':com', $this->commentaire);

     //Execute update query
     if ($stmt->execute()) {
       return true;
     } else {
        return false;
     }
    }

    /**DELETE contrat by ID**/
    function deleteContrat()
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE no_contrat = ?";

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
