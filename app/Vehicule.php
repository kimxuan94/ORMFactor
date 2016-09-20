<?php

class Vehicule {

  //Database connection property object and table name property
  private $conn;
  private $table_name = "vehicule";

  //Create object properties of collaborateurs
  public $id;
  public $immatriculation;
  public $no_contrat;
  public $loueur;
  public $valeur_achat;
  public $date_circulation;
  public $date_entree_parc;
  public $date_sortie;
  public $categorie_veh;
  public $marque;
  public $modele;
  public $version;
  public $no_chassis;
  public $boite_vitesse;
  public $chevaux;
  public $km;
  public $portes;
  public $places;
  public $reservoir;
  public $carburant;
  public $consommation_mixte;
  public $indice_co2;
  public $detention;
  public $lfinancier;
  public $lpfinanciere;
  public $lpneu;
  public $lautre;
  public $ltotal;
  public $commentaire;

  //Create vehicule constructor
  public function __construct($db) {
    $this->conn = $db;
  }

  /**CREATE vehicule**/
  function createVehicule() {

      //Create query
      $query = "INSERT INTO " . $this->table_name . " values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->id);
      $stmt->bindParam(2, $this->immatriculation);
      $stmt->bindParam(3, $this->no_contrat);
      $stmt->bindParam(4, $this->loueur);
      $stmt->bindParam(5, $this->valeur_achat);
      $stmt->bindParam(6, $this->date_circulation);
      $stmt->bindParam(7, $this->date_entree_parc);
      $stmt->bindParam(8, $this->date_sortie);
      $stmt->bindParam(9, $this->categorie_veh);
      $stmt->bindParam(10, $this->marque);
      $stmt->bindParam(11, $this->modele);
      $stmt->bindParam(12, $this->version);
      $stmt->bindParam(13, $this->no_chassis);
      $stmt->bindParam(14, $this->boite_vitesse);
      $stmt->bindParam(15, $this->chevaux);
      $stmt->bindParam(16, $this->km);
      $stmt->bindParam(17, $this->portes);
      $stmt->bindParam(18, $this->places);
      $stmt->bindParam(19, $this->reservoir);
      $stmt->bindParam(20, $this->carburant);
      $stmt->bindParam(21, $this->consommation_mixte);
      $stmt->bindParam(22, $this->indice_co2);
      $stmt->bindParam(23, $this->detention);
      $stmt->bindParam(24, $this->commentaire);

      if($stmt->execute()) {
        return true;
      } else {
        return false;
      }
  }

  /**READ vehicules**/
  function readAll($page, $from_record_num, $records_per_page) {

    $query = "SELECT *,
                        DATE_FORMAT(date_circulation, '%d/%m/%Y') as date_circulation,
                        DATE_FORMAT(date_entree_parc, '%d/%m/%Y') as date_entree_parc,
                        DATE_FORMAT(date_sortie, '%d/%m/%Y') as date_sortie
                        -- SUM(loyer_financier + loyer_p_financiere + loyer_pneu + loyer_autre ) as loyer_total

      -- DATE_FORMAT(date_facturation, 'Y-m-d H:i:s',timestamp) as date_facturation,
     FROM " . $this->table_name . " GROUP BY id
     ASC LIMIT {$from_record_num}, {$records_per_page}";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
  }

  /**PAGINATION for vehicules**/
    public function countAll(){

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

  /**READ vehicule by ID after update**/
    function readVehiculeID(){

        // $query = "SELECT * FROM  " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $query = "SELECT *,
                      DATE_FORMAT(date_circulation, '%d/%m/%Y') as date_circulation,
                      DATE_FORMAT(date_entree_parc, '%d/%m/%Y') as date_entree_parc,
                      DATE_FORMAT(date_sortie, '%d/%m/%Y') as date_sortie
         FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->immatriculation = $row['immatriculation'];
        $this->no_contrat = $row['no_contrat'];
        $this->loueur = $row['loueur'];
        $this->valeur_achat = $row['valeur_achat'];
        $this->date_circulation = $row['date_circulation'];
        $this->date_entree_parc = $row['date_entree_parc'];
        $this->date_sortie = $row['date_sortie'];
        $this->categorie_veh = $row['categorie'];
        $this->marque = $row['marque'];
        $this->modele = $row['modele'];
        $this->version = $row['version'];
        $this->no_chassis = $row['no_chassis'];
        $this->commentaire = $row['commentaire'];

    }

    /**UPDATE for vehicule**/
    function updateVehicule(){
      $query = "UPDATE " . $this->table_name . "
      SET
        id = :id,
        immatriculation = :immatveh,
        no_contrat = :nocontrat,
        loueur = :loueur,
        valeur_achat = :val,
        date_circulation = :circulation,
        date_entree_parc = :entree,
        sortie_parc = :sortie,
        categorie_veh = :categorie,
        marque = :marque,
        modele = :modele,
        version = :version,
        no_chassis = :nochassis,
        commentaires = :com,
     WHERE
       id = :id";

     $stmt = $this->conn->prepare($query);

     $stmt->bindParam(':id', $this->id);
     $stmt->bindParam(':immatveh', $this->immatriculation);
     $stmt->bindParam(':nocontrat', $this->no_contrat);
     $stmt->bindParam(':loueur', $this->loueur);
     $stmt->bindParam(':val', $this->valeur_achat);
     $stmt->bindParam(':circulation', $this->date_circulation);
     $stmt->bindParam(':entree', $this->date_entree_parc);
     $stmt->bindParam(':sortie', $this->sortie_parc);
     $stmt->bindParam(':categorie', $this->categorie_veh);
     $stmt->bindParam(':marque', $this->marque);
     $stmt->bindParam(':modele', $this->modele);
     $stmt->bindParam(':version', $this->version);
     $stmt->bindParam(':nochassis', $this->no_chassis);
     $stmt->bindParam(':com', $this->commentaire);

     //Execute update query
     if ($stmt->execute()) {
       return true;
     } else {
        return false;
     }
    }

    /**DELETE vehicule by ID**/
    function deleteVehicule()
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

    // function setCategories(){
    //   $categories=array(
    //   "Vpro" => 'VP',
    //   "VUsage" => 'VU',
    //   "VIndustriel" => 'VI',
    //    );
    //
    //    echo '<label>Catégorie véhicule:</label><select class="form-control" id="categorie" name="categorie">';
    //      foreach($categories as $key => $value){
    //      echo '<option value="'.$key.'">'.$value.'</option>'; //close your tags!!
    //    }
    //     echo '</select><br />';
    // }

    function setCategorieVeh(){
        echo '<label>Catégorie Véhicule:</label><select class="form-control" name="vehicule">';

                $categorie_veh = ['VI', 'VP', 'VU'];
                for($i=0; $i < count($categorie_veh); $i++){

                  echo '<option>'.$categorie_veh[$i].'</option>';
                }
        echo '</select><br />';
    }

    function setDetention(){
        echo '<label>Type Détention:</label><select class="form-control" name="detention">';

                $detention = ['Achat', 'LCD', 'LLD'];
                for($i=0; $i < count($detention); $i++){

                  echo '<option>'.$detention[$i].'</option>';
                }
        echo '</select><br />';
    }

    function setCarburant(){
        echo '<label>Type Carburant:</label><select class="form-control" name="carburant">';

                $carburant = ['Diesel', 'Essence', 'Gazole'];
                for($i=0; $i < count($carburant); $i++){

                  echo '<option>'.$carburant[$i].'</option>';
                }
        echo '</select><br />';
    }

    function setJSON() {
      /* but for the sake of an example let's just set the string here */
      // $jsonString = '{"id":"3","raison_sociale":"CLEO"}';
      $jsonString = file_get_contents('./public/js/renter.json');

      /* use json_decode to create an array from json */
      $jsonArray = json_decode($jsonString, true);

      /* create a prepared statement */
      // if ($stmt = $conn->prepare('INSERT INTO loueurs (id, raison_sociale) VALUES (?,?)')) {
      //
      //   /* bind parameters for markers */
      //   $stmt->bind_param("ssss", $jsonArray['rsociale'], $jsonArray['id']);
      //   /* execute query */
      //   $stmt->execute();
      //   /* close statement */
      //   $stmt->close();

      //
      // $query = "INSERT INTO loueurs (id, raison_sociale) VALUES (?,?)";
      // $stmt = $this->conn->prepare($query);
      // $stmt->bindParam(1, $jsonArray['renter']['id']);
      // $stmt->bindParam(2, $jsonArray['renter']['rsociale']);
      // $stmt->execute();

    }

    function setDropdown() {
      // $myJson = "{'key':'value'}";
      // $myJson = file_get_contents('./public/js/renter.json');
      $jsonString = '{"id":"NULL","raison_sociale":["ADA","ALAMO","ALDAU","ALPHABET","ARVAL", "AVIS RENT A CAR","BUDGET","EUROPCAR","LEASEPLAN","HERTZ LOCATION","NATIONAL","SIXT ENTREPRISE","THRIFTY"]}';

        // $myArray = json_decode($jsonString);
        $myArray = json_decode($jsonString,TRUE);

        // echo $myArray[1]['raison_sociale'];

        $select = "<br /><label>Loueurs</label><select class='form-control' id='loueur' name='loueur'>";

        foreach((array)$myArray['raison_sociale'] as $key=>$val){
            $select .= "<option value='". $key."' >". $val."</option>";
        }

        $select .= "</select>";

        echo $select;

        $query = "INSERT INTO loueurs (id, raison_sociale) VALUES (?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $myArray['renter']['id']);
        $stmt->bindParam(2, $myArray['renter']['raison_sociale']);
        $stmt->execute();
    }


    function setMakers() {
      // $myJson = "{'key':'value'}";
      // $myJson = file_get_contents('./public/js/renter.json');
      // $jsonString = '{"id":"NULL","raison_sociale":["ADA","ALAMO","ALDAU","ALPHABET","ARVAL", "AVIS RENT A CAR","BUDGET","EUROPCAR","LEASEPLAN","HERTZ LOCATION","NATIONAL","SIXT ENTREPRISE","THRIFTY"]}';

      $jsonString = file_get_contents('http://api.edmunds.com/api/vehicle/v2/makes?fmt=json&api_key=r8xsuf2vtd8a8nvxt7jaw2dc');
        // $myArray = json_decode($jsonString);
        $myArray = json_decode($jsonString, TRUE);

        // echo $myArray[1]['raison_sociale'];

        $select = "<label>Constructeurs</label><select class='form-control' id='makes' name='makes'>";

        foreach((array)$myArray['makes'] as $key=>$val){
            $select .= "<option value='". $key."' >". $val['name']."</option>";
        }
        $select .= "</select><br />";

        echo $select;

        $query = "INSERT INTO marque (id, libelle) VALUES (?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $myArray['makes']['id']);
        $stmt->bindParam(2, $myArray['makes']['name']);
        $stmt->execute();
    }
}
?>
