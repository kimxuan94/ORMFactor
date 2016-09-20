<?php

class Collaborateur {

  //Database connection property object and table name property
  private $conn;
  private $table_name = "Collaborateurs";

  //Create object properties of collaborateurs
  public $idmatrh;
  public $nom;
  public $prenom;
  public $adresse;
  public $codepostal;
  public $ville;
  public $telephone;
  public $profession;
  public $justificatif;
  public $avantage;
  public $date_entree;
  public $date_sortie;
  public $commentaire;

  //Create collaborateur constructor
  public function __construct($db) {
    $this->conn = $db;
  }

  /**CREATE collaborateur**/
  function createCollaborateur() {


      //Create query
      $query = "INSERT INTO " . $this->table_name . " values(?,?,?,?,?,?,?,?,?,?,?,?,?)";

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->idmatrh);
      $stmt->bindParam(2, $this->nom);
      $stmt->bindParam(3, $this->prenom);
      $stmt->bindParam(4, $this->adresse);
      $stmt->bindParam(5, $this->codepostal);
      $stmt->bindParam(6, $this->ville);
      $stmt->bindParam(7, $this->telephone);
      $stmt->bindParam(8, $this->profession);
      $stmt->bindParam(9, $this->justificatif);
      $stmt->bindParam(10, $this->avantage);
      $stmt->bindParam(11, $this->date_entree);
      $stmt->bindParam(12, $this->date_sortie);
      $stmt->bindParam(13, $this->commentaire);

      if($stmt->execute()) {
        return true;
      } else {
        return false;
      }
  }

  /**READ collaborateur**/
  function readAll($page, $from_record_num, $records_per_page) {

      $query = "SELECT *,
                    DATE_FORMAT(date_entree, '%d/%m/%Y') as date_entree,
                    DATE_FORMAT(date_sortie, '%d/%m/%Y') as date_sortie
       FROM " . $this->table_name . " GROUP BY id_matrh ASC LIMIT {$from_record_num}, {$records_per_page}";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      // $stmt->bindColumn(1, $idmatrh);
      // $stmt->bindColumn(9, $justificatif, PDO::PARAM_LOB);

      return $stmt;
  }

  /**PAGINATION for collaborateur**/
    public function countAll(){

        $query = "SELECT id_matrh FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

  /**READ collaborateur by ID after update**/
    function readCollaborateurID(){

        $query = "SELECT * FROM  " . $this->table_name . " WHERE id_matrh = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->idmatrh);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->idmatrh = $row['id_matrh'];
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->adresse = $row['adresse'];
        $this->codepostal = $row['code_postal'];
        $this->ville = $row['ville'];
        $this->telephone = $row['telephone'];
        $this->profession = $row['profession'];
        $this->justificatif = $row['justificatif'];
        $this->avantage = $row['avantage_nature'];
        $this->date_entree = $row['date_entree'];
        $this->date_sortie = $row['date_sortie'];
        $this->commentaire = $row['commentaires'];
    }

    /**UPDATE for collaborateur**/
    function updateCollaborateur(){
      $query = "UPDATE " . $this->table_name . "
      SET
        id_matrh = :id;
        nom = :nm,
        prenom = :pre,
        adresse = :ad
        code_postal = :cod,
        ville = :vi,
        telephone = :tel,
        profession = :prof,
        justificatif = :jus,
        avantage_nature = :avnt
        date_entree = :deb,
        date_sortie = :fin,
        commentaires = :com
     WHERE
       id_matrh = :id";

     $stmt = $this->conn->prepare($query);

     $stmt->bindParam(':id', $this->idmatrh);
     $stmt->bindParam(':nm', $this->nom);
     $stmt->bindParam(':pre', $this->prenom);
     $stmt->bindParam(':ad', $this->adresse);
     $stmt->bindParam(':cod', $this->codepostal);
     $stmt->bindParam(':vi', $this->ville);
     $stmt->bindParam(':tel', $this->telephone);
     $stmt->bindParam(':prof', $this->profession);
     $stmt->bindParam(':jus', $this->justificatif);
     $stmt->bindParam(':avnt', $this->avantage);
     $stmt->bindParam(':deb', $this->date_entree);
     $stmt->bindParam(':fin', $this->date_sortie);
     $stmt->bindParam(':com', $this->commentaire);

     //Execute update query
     if ($stmt->execute()) {
       return true;
     } else {
        return false;
     }
    }

    /**DELETE collaborateur by ID**/
    function deleteCollaborateur()
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE id_matrh = ?";

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
