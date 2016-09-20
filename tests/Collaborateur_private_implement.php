<?php

class Collaborateur {

  //Database connection properties
  public $conn;
  public $table_name = "collaborateur";


  /*Public default properties
  /* We can set certain properties as public when there are no sensitive
  */
  public $id;
  public $avantage;
  public $commentaire;

  /*Private implementation Test
  * All those informations are considered as sensitive so we set up as private
  */

  private $matriculerh;
  private $nom;
  private $prenom;
  private $adresse;
  private $cp;
  private $ville;
  private $tel;
  private $date_entree;
  private $date_sortie;

  //Create collaborateur constructor
  public function __construct($db) {
    $this->conn = $db;
  }

  /*
  * Functions to access to private informations
  */

  function getMatriculeRH(){
    echo $this->matriculerh;
  }

  function getNom(){
    echo $this->nom;
  }

  function getPrenom(){
    echo $this->prenom;
  }

  function getAdresse(){
    echo $this->adresse;
  }

  function getCP(){
    echo $this->cp;
  }

  function getVille(){
    echo $this->cp;
  }

  function getTel(){
    echo $this->tel;
  }

  function getDateEntree(){
    echo $this->date_entree;
  }

  function getDateSortie(){
    echo $this->date_sortie;
  }

  /**CREATE collaborateur**/
  function createCollaborateur() {


      //Create query
      $query = "INSERT INTO " . $this->table_name . " values(?,?,?,?,?,?,?,?,?,?,?,?)";

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->id);
      $stmt->bindParam(2, $this->matriculerh);
      $stmt->bindParam(3, $this->nom);
      $stmt->bindParam(4, $this->prenom);
      $stmt->bindParam(5, $this->adresse);
      $stmt->bindParam(6, $this->cp);
      $stmt->bindParam(7, $this->ville);
      $stmt->bindParam(8, $this->tel);
      $stmt->bindParam(9, $this->avantage);
      $stmt->bindParam(10, $this->date_entree);
      $stmt->bindParam(11, $this->date_sortie);
      $stmt->bindParam(12, $this->commentaire);

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
       FROM " . $this->table_name . " GROUP BY id ASC LIMIT {$from_record_num}, {$records_per_page}";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      // $stmt->bindColumn(1, $idmatrh);
      // $stmt->bindColumn(9, $justificatif, PDO::PARAM_LOB);

      return $stmt;
  }

  /**PAGINATION for collaborateur**/
    public function countAll(){

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

  /**READ collaborateur by ID after update**/
    function readCollaborateurID(){

        $query = "SELECT * FROM  " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->matriculerh = $row['matriculerh'];
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->adresse = $row['adresse'];
        $this->cp = $row['cp'];
        $this->ville = $row['ville'];
        $this->tel = $row['tel'];
        $this->avantage = $row['avantages'];
        $this->date_entree = $row['date_entree'];
        $this->date_sortie = $row['date_sortie'];
        $this->commentaire = $row['commentaire'];
    }

    /**UPDATE for collaborateur**/
    function updateCollaborateur(){
      $query = "UPDATE " . $this->table_name . "
      SET
        id = :id,
        matriculerh = :idrh,
        nom = :nm,
        prenom = :pre,
        adresse = :ad,
        cp = :cod,
        ville = :vi,
        tel = :tel,
        avantages = :avnt,
        date_entree = :deb,
        date_sortie = :fin,
        commentaire = :com
     WHERE
        id = :id";

     $stmt = $this->conn->prepare($query);

     $stmt->bindParam(':id', $this->id);
     $stmt->bindParam(':idrh', $this->matriculehr);
     $stmt->bindParam(':nm', $this->nom);
     $stmt->bindParam(':pre', $this->prenom);
     $stmt->bindParam(':ad', $this->adresse);
     $stmt->bindParam(':cod', $this->cp);
     $stmt->bindParam(':vi', $this->ville);
     $stmt->bindParam(':tel', $this->tel);
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

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function sayHello(){
      echo 'Test alert';
    }

    function setAlerte(){

            // $query = "SELECT *,
            //               DATE_FORMAT(date_entree, '%d/%m/%Y') as date_entree,
            //               DATE_FORMAT(date_sortie, '%d/%m/%Y') as date_sortie
            //  FROM " . $this->table_name . " GROUP BY id_matrh";

            $query = "SELECT , PERIOD_DIFF(EXTRACT(YEAR_MONTH FROM date_entree), EXTRACT(YEAR_MONTH FROM date_sortie)) AS Ancienneté
              FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            // $stmt->bindColumn(1, $idmatrh);
            // $stmt->bindColumn(9, $justificatif, PDO::PARAM_LOB);

            return $stmt;
    }
}
?>
