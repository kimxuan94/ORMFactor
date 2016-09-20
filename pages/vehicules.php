<?php
session_set_cookie_params(0, "/");
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;

include_once '../app/Database.php';
include_once '../app/Vehicule.php';

error_reporting(E_ALL);
ini_set('display_errors', true);

//Set connection to Database
$database = new Database();
$db = $database->getConnection();

$vehicule = new Vehicule($db);

$stmt = $vehicule->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();
?>

<link href="../public/css/bootstrap.min.css" rel="stylesheet">
<link href="../public/css/views.css" rel="stylesheet">
   <p><br/></p>
   <p>
<a class="btn btn-primary" href="../ajouter_vehicule.php" role="button">Créer un nouveau véhicule</a>
<a class="btn btn-info" href="../pages/dashboard.php" role="button">Aller au tableau de bord</a>
   </p>
   <caption><legend>Véhicules</legend></caption>
     <div class="container">
       <!-- <p>
 	<a class="btn btn-primary" href="ajouter_vehicule.php" role="button">Créer un nouveau véhicule</a>
  <a class="btn btn-info" href="index.php" role="button">Aller au tableau de bord</a>
       </p> -->
       <?php
     if($num>0){
     ?>
 	<table class="table table-bordered table-hover table-striped">
 	<thead>
 	 <tr>
           <th>Immatriculation</th>
           <th>N°contrat</th>
           <th>Loueur</th>
           <th>Valeur d'achat</th>
           <th>Date circulation</th>
           <th>Entrée parc</th>
           <th>Sortie parc</th>
           <th>Catégorie véhicule</th>
           <th>Marque</th>
           <th>Modèle</th>
           <th>Version</th>
           <th>N°chassis</th>
           <th>Type de boite de vitesse</th>
           <th>Puissance fiscale (ch) </th>
           <th>Kilomètrage</th>
           <th>Portes</th>
           <th>Places</th>
           <th>Réservoir</th>
           <th>Carburant</th>
           <th>Consommation mixte</th>
           <th>Indice CO2</th>
           <th>Détention (LLD,LCD, Achat)</th>
           <th>Loyer financier</th>
           <th>Loyer de perte financière</th>
           <th>Loyer pneu</th>
           <th>Loyer autre</th>
           <th>Total loyers</th>
           <th>Commentaire</th>
           <th>Actions</th>
         </tr>
 	</thead>
 	  <tbody>
    <?php
      //Display collaborateur properties here
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
       ?>
      <tr>
        <?= "<td>{$immatriculation}</td>" ?>
        <?= "<td>{$no_contrat}</td>" ?>
        <?= "<td>{$loueur}</td>" ?>
        <?= "<td>{$valeur_achat} €</td>" ?>
        <?= "<td>{$date_circulation}</td>" ?>
        <?= "<td>{$date_entree_parc}</td>" ?>
        <?= "<td>{$date_sortie}</td>" ?>
        <?= "<td>{$categorie}</td>" ?>
        <?= "<td>{$marque}</td>" ?>
        <?= "<td>{$modele}</td>" ?>
        <?= "<td>{$version}</td>" ?>
        <?= "<td>{$no_chassis}</td>" ?>
        <?= "<td>{$boite_vitesse}</td>" ?>
        <?= "<td>{$chevaux} ch</td>" ?>
        <?= "<td>{$km}</td>" ?>
        <?= "<td>{$portes}</td>" ?>
        <?= "<td>{$places}</td>" ?>
        <?= "<td>{$reservoir}</td>" ?>
        <?= "<td>{$carburant}</td>" ?>
        <?= "<td>{$consommation_mixte}</td>" ?>
        <?= "<td>{$indice_co2} g</td>" ?>
        <?= "<td>{$detention}</td>" ?>
        <?= "<td>".$_SESSION['lfin']." €"."</td>" ?>
        <?= "<td>".$_SESSION['lpfin']." €"."</td>" ?>
        <?= "<td>".$_SESSION['lpneu']." €"."</td>" ?>
        <?= "<td>".$_SESSION['lautre']." €"."</td>" ?>
        <?= "<td>".$_SESSION['ltotal']." €"."</td>" ?>
        <?= "<td>{$commentaire}</td>" ?>
        <?= "<td width='170px'>
            <a class='btn btn-default btn-sm' href='../read_vehicule.php?id={$id}' role='button'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a>
      	    <a class='btn btn-warning btn-sm' href='../maj_vehicule.php?id={$id}' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
      	    <a class='btn btn-danger btn-sm' href='../del_vehicule.php?id={$id}' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                </td>" ?>
              </tr>
              <?php
              }
              ?>
              	</tbody>
                    </table>
              <?php
              $page_dom = "vehicule.php";
              include_once '../app/pagination.veh.php';
              }
              else{
              ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Attention!</strong> Vous n'avez aucun véhicule
              </div>
              <?php
              }
              ?>

              <?php
              // echo "Loyer Financier = ". $_SESSION['lfin']."€". '<br />'; //retrieve data
              // echo "Loyer Perte Financiere = ". $_SESSION['lpfin']."€". '<br />'; //retrieve data
              // echo "Loyer Pneu = ". $_SESSION['lpneu']."€". '<br />'; //retrieve data
              // echo "Loyer Autre = ". $_SESSION['lautre']."€". '<br />'; //retrieve data
              // echo "Total Loyer = ". $_SESSION['ltotal']."€". '<br />'; //retrieve data
              // echo "IMMAT = ". $_SESSION['immatriculation']. '<br />'; //retrieve data

              ?>
  </div>
