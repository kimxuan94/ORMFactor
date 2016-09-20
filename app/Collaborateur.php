<?php

class Collaborateur {

  //Database connection properties
  public $conn;
  public $table_name = "collaborateur";


  /*Public default properties
  /* We can set certain properties as public when there are no sensitive
  */

  public $id;
  public $matriculerh;
  public $nom;
  public $prenom;
  public $adresse;
  public $cp;
  public $ville;
  public $tel;
  public $categorie_pro;
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
      //
      $stmt->bindParam(1, $this->id);
      $stmt->bindParam(2, $this->matriculerh);
      $stmt->bindParam(3, $this->nom);
      $stmt->bindParam(4, $this->prenom);
      $stmt->bindParam(5, $this->adresse);
      $stmt->bindParam(6, $this->cp);
      $stmt->bindParam(7, $this->ville);
      $stmt->bindParam(8, $this->tel);
      $stmt->bindParam(9, $this->categorie_pro);
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

        // $query = "SELECT * FROM  " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $query = "SELECT *,
                      DATE_FORMAT(date_entree, '%d/%m/%Y') as date_entree,
                      DATE_FORMAT(date_sortie, '%d/%m/%Y') as date_sortie
         FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

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
        $this->categorie_pro = $row['categorie_pro'];
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
        categorie_pro = :catpro,
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
     $stmt->bindParam(':catpro', $this->categorie_pro);
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

    function setCategoriePro(){
        echo '<label>Catégorie Professionnelle:</label><select class="form-control" name="pro">';

                $profession = ['APM', 'AR', 'ARS'];
                for($i=0; $i < count($profession); $i++){

                  echo '<option>'.$profession[$i].'</option>';
                }
        echo '</select><br />';
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
