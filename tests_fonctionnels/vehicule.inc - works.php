<?php

class Vehicule {

  //Database connection property object and table name property
  private $conn;
  private $table_name = "Vehicules";

  //Create object properties of collaborateurs
  public $idimmatveh;
  public $num_contrat;
  public $loueur;
  public $val_achat;
  public $premiere_circulation;
  public $entree_parc;
  public $sortie_parc;
  public $categorie;
  public $marque;
  public $modele;
  public $version;
  public $num_chassis;
  public $boite_vitesse;
  public $puissance_fiscale;
  public $km;
  public $portes;
  public $places;
  public $reservoir;
  public $carburant;
  public $consomixte;
  public $co2;
  public $detention;
  public $loyer_financier;
  public $loyer_p_financier;
  public $loyer_pneu;
  public $loyer_autre;
  public $loyer_total;
  public $commentaire;


  //Create vehicule constructor
  public function __construct($db) {
    $this->conn = $db;
  }

  /**CREATE vehicule**/
  function createVehicule() {

      //Create query
      $query = "INSERT INTO " . $this->table_name . " values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->idimmatveh);
      $stmt->bindParam(2, $this->num_contrat);
      $stmt->bindParam(3, $this->loueur);
      $stmt->bindParam(4, $this->val_achat);
      $stmt->bindParam(5, $this->premiere_circulation);
      $stmt->bindParam(6, $this->entree_parc);
      $stmt->bindParam(7, $this->sortie_parc);
      $stmt->bindParam(8, $this->categorie);
      $stmt->bindParam(9, $this->marque);
      $stmt->bindParam(10, $this->modele);
      $stmt->bindParam(11, $this->version);
      $stmt->bindParam(12, $this->num_chassis);
      $stmt->bindParam(13, $this->boite_vitesse);
      $stmt->bindParam(14, $this->puissance_fiscale);
      $stmt->bindParam(15, $this->km);
      $stmt->bindParam(16, $this->portes);
      $stmt->bindParam(17, $this->places);
      $stmt->bindParam(18, $this->reservoir);
      $stmt->bindParam(19, $this->carburant);
      $stmt->bindParam(20, $this->consomixte);
      $stmt->bindParam(21, $this->co2);
      $stmt->bindParam(22, $this->detention);
      $stmt->bindParam(23, $this->loyer_financier);
      $stmt->bindParam(24, $this->loyer_p_financier);
      $stmt->bindParam(25, $this->loyer_pneu);
      $stmt->bindParam(26, $this->loyer_autre);
      $stmt->bindParam(27, $this->loyer_total);
      $stmt->bindParam(28, $this->commentaire);

      if($stmt->execute()) {
        return true;
      } else {
        return false;
      }
  }

  /**READ vehicules**/
  function readAll($page, $from_record_num, $records_per_page) {

    $query = "SELECT *,
                        DATE_FORMAT(prem_circulation, '%d/%m/%Y') as prem_circulation,
                        DATE_FORMAT(entree_parc, '%d/%m/%Y') as entree_parc,
                        DATE_FORMAT(sortie_parc, '%d/%m/%Y') as sortie_parc,
                        SUM(loyer_financier + loyer_p_financiere + loyer_pneu + loyer_autre ) as loyer_total

      -- DATE_FORMAT(date_facturation, 'Y-m-d H:i:s',timestamp) as date_facturation,
     FROM " . $this->table_name . " GROUP BY id_immatveh
     ASC LIMIT {$from_record_num}, {$records_per_page}";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
  }

  /**PAGINATION for vehicules**/
    public function countAll(){

        $query = "SELECT id_immatveh FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

  /**READ vehicule by ID after update**/
    function readVehiculeID(){

        $query = "SELECT * FROM  " . $this->table_name . " WHERE id_immatveh = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->idimmatveh = $row['id_immatveh'];
        $this->num_contrat = $row['num_contrat'];
        $this->loueur = $row['nom_loueur'];
        $this->val_achat = $row['val_achat'];
        $this->premiere_circulation = $row['prem_circulation'];
        $this->entree_parc = $row['entree_parc'];
        $this->sortie_parc = $row['sortie_parc'];
        $this->categorie = $row['cat_vehicule'];
        $this->marque = $row['marque'];
        $this->modele = $row['modele'];
        $this->version = $row['version'];
        $this->num_chassis = $row['no_chassis'];
        $this->boite_vitesse = $row['boite_vitesse'];
        $this->puissance_fiscale = $row['puissance_fiscale'];
        $this->km = $row['nb_km'];
        $this->portes = $row['nb_portes'];
        $this->places = $row['nb_places'];
        $this->reservoir = $row['reservoir'];
        $this->carburant = $row['carburant'];
        $this->consomixte = $row['conso_mixte'];
        $this->co2 = $row['qte_co2'];
        $this->detention = $row['detention'];
        $this->loyer_financier = $row['loyer_financier'];
        $this->loyer_p_financier = $row['loyer_p_financiere'];
        $this->loyer_pneu = $row['loyer_pneu'];
        $this->loyer_autre = $row['loyer_autre'];
        $this->loyer_total = $row['loyer_total'];
        $this->commentaire = $row['commentaires'];

    }

    /**UPDATE for vehicule**/
    function updateVehicule(){
      $query = "UPDATE " . $this->table_name . "
      SET
        id_immatveh = :idveh,
        num_contrat = :nm,
        nom_loueur = :lou,
        val_achat = :val,
        prem_circulation = :pcir,
        entree_parc = :ent,
        sortie_parc = :sor,
        cat_vehicule = :cat,
        marque = :mar,
        modele = :mod,
        version = :ver,
        no_chassis = :nch,
        boite_vitesse = :bvi,
        puissance_fiscale = :pfis,
        nb_km = :nkm,
        nb_portes = :npo,
        nb_places = :npl,
        reservoir = :res,
        carburant = :car,
        conso_mixte = :cmi,
        qte_co2 = :co2,
        detention = :tdet,
        loyer_financier = :lfi,
        loyer_p_financiere = :lpf,
        loyer_pneu = :lpn,
        loyer_autre = :lau,
        loyer_total = :lto,
        commentaires = :com,
     WHERE
       id_immatveh = :idveh";

     $stmt = $this->conn->prepare($query);

     $stmt->bindParam(':idveh', $this->idimmatveh);
     $stmt->bindParam(':nm', $this->num_contrat);
     $stmt->bindParam(':lou', $this->loueur);
     $stmt->bindParam(':val', $this->val_achat);
     $stmt->bindParam(':pcir', $this->premiere_circulation);
     $stmt->bindParam(':ent', $this->entree_parc);
     $stmt->bindParam(':sor', $this->sortie_parc);
     $stmt->bindParam(':cat', $this->categorie);
     $stmt->bindParam(':mar', $this->marque);
     $stmt->bindParam(':mod', $this->modele);
     $stmt->bindParam(':ver', $this->version);
     $stmt->bindParam(':nch', $this->num_chassis);
     $stmt->bindParam(':bvi', $this->boite_vitesse);
     $stmt->bindParam(':pfis', $this->puissance_fiscale);
     $stmt->bindParam(':nkm', $this->km);
     $stmt->bindParam(':npo', $this->portes);
     $stmt->bindParam(':npl', $this->places);
     $stmt->bindParam(':res', $this->reservoir);
     $stmt->bindParam(':car', $this->carburant);
     $stmt->bindParam(':cmi', $this->consomixte);
     $stmt->bindParam(':co2', $this->co2);
     $stmt->bindParam(':tdet', $this->detention);
     $stmt->bindParam(':lfi', $this->loyer_financier);
     $stmt->bindParam(':lpf', $this->loyer_p_financier);
     $stmt->bindParam(':lpn', $this->loyer_pneu);
     $stmt->bindParam(':lau', $this->loyer_autre);
     $stmt->bindParam(':lto', $this->loyer_total);
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

        $query = "DELETE FROM " . $this->table_name . " WHERE id_immatveh = ?";

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
