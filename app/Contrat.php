<?php

class Contrat {

  //Database connection property object and table name property
  private $conn;
  private $table_name = "contrat";

  //Create object properties of contrats
  public $id;
  public $ref_contrat;
  public $collaborateur;

  //Create contrat constructor
  public function __construct($db) {
    $this->conn = $db;
  }

  /**CREATE contrat**/
  function createContrat() {

      //Create query
      $query = "INSERT INTO " . $this->table_name . " values(?,?)";

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->ref_contrat);
      $stmt->bindParam(2, $this->collaborateur);

      if($stmt->execute()) {
        return true;
      } else {
        return false;
      }
  }

  /**READ contrats**/
  function readAll($page, $from_record_num, $records_per_page) {

      // $query = "SELECT * FROM " . $this->table_name . " ORDER BY no_contrat ASC LIMIT {$from_record_num}, {$records_per_page}";

      $query = "SELECT *
                      -- DATE_FORMAT(debut_contrat, '%d/%m/%Y') as debut_contrat,
                      -- DATE_FORMAT(fin_contrat, '%d/%m/%Y') as fin_contrat
       FROM " . $this->table_name . "
                   GROUP BY ref_contrat ASC LIMIT {$from_record_num}, {$records_per_page}";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
  }

  /**PAGINATION for contrat**/
    public function countAll(){

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

  /**READ contrat by ID after update**/
    function readContratID(){

        $query = "SELECT * FROM  " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->no_contrat = $row['ref_contrat'];
        $this->idimmatveh = $row['collaborateur'];
    }

    /**UPDATE for contrat**/
    function updateContrat(){
      $query = "UPDATE " . $this->table_name . "
      SET
        id = :id,
        ref_contrat = :ref
        collaborateur = :collaborateur,
     WHERE
       id = :id";

     $stmt = $this->conn->prepare($query);

     $stmt->bindParam(':id', $this->id);
     $stmt->bindParam(':ref', $this->ref_contrat);
     $stmt->bindParam(':collaborateur', $this->idmatrh);
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

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function getMatRH(){
      // $sth = $this->conn->prepare("SELECT matriculerh FROM collaborateur");

      $query = "SELECT matriculerh FROM collaborateur";

      $stmt = $this->conn->prepare($query);
      $sth->execute();

      $option = '';
      /*$res = $sth->fetchAll(PDO::FETCH_ASSOC);
      print_r($res);*/
      echo '<label>Matricule salarié</label><select class="form-control" id="smatricule" name="smatricule">';

      while($row = $sth->fetch(PDO::FETCH_ASSOC))
      {
        $option .= '<option value = "'.$row['smatriculerh'].'">'.$row['matriculerh'].'</option>';
      }
      echo '</select>';
    }

    //Récupère tous les matricules RH dans la la liste matricules
}//End of class
?>
