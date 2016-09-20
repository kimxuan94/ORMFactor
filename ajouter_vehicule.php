<?php
// page1.php
session_set_cookie_params(0, "/"); 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once './app/Database.php';

//Set new connection
$database = new Database();
$db = $database->getConnection();

include_once './app/Vehicule.php';
$vehicule = new Vehicule($db);

include_once './app/Loueur.php';
$loueur = new Loueur($db);

include_once './app/Categorie.php';
$categorie = new Categorie($db);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer un véhicule</title>

    <!-- Bootstrap -->
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/views.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">


    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body>
  <style>
  .label-info {
    background-color: purple;
  }
  </style>
<p><br/></p>
<div class="container">
    <p>
        <a class="btn btn-primary" href="./pages/vehicules.php" role="button">Retour</a>
    </p><br/>
    <?php
    if ($_POST) {

        $vehicule->immatriculation = $_POST['immatriculation'];
        $vehicule->no_contrat = $_POST['nocontrat'];
        $vehicule->loueur = $_POST['loueur'];
        $vehicule->valeur_achat = $_POST['vachat'];
        $vehicule->date_circulation = $_POST['circulation'];
        $vehicule->date_entree_parc = $_POST['entree'];
        $vehicule->date_sortie = $_POST['sortie'];
        $vehicule->categories = $_POST['vehicule'];
        $vehicule->marque = $_POST['makes'];
        $vehicule->modele = $_POST['modele'];
        $vehicule->version = $_POST['version'];
        $vehicule->no_chassis = $_POST['nochassis'];
        $vehicule->boite_vitesse = $_POST['bvitesse'];
        $vehicule->chevaux = $_POST['chevaux'];
        $vehicule->km = $_POST['km'];
        $vehicule->portes = $_POST['portes'];
        $vehicule->places = $_POST['places'];
        $vehicule->reservoir = $_POST['reservoir'];
        $vehicule->carburant = $_POST['carburant'];
        $vehicule->consommation_mixte = $_POST['conso_mixte'];
        $vehicule->indice_co2 = $_POST['co2'];
        $vehicule->detention = $_POST['detention'];
        $vehicule->lfinancier = $_POST['lfin'];
        $vehicule->lpfinanciere = $_POST['lpfin'];
        $vehicule->lpneu = $_POST['lpneu'];
        $vehicule->lautre = $_POST['lautre'];
        $vehicule->ltotal = $_SESSION['ltotal'];
        $vehicule->commentaire = $_POST['commentaire'];

        $_SESSION['immatriculation'] = $_POST['immatriculation'];
        $_SESSION['lfin'] = $_POST['lfin'];
        $_SESSION['lpfin'] = $_POST['lpfin'];
        $_SESSION['lpneu'] = $_POST['lpneu'];
        $_SESSION['lautre'] = $_POST['lautre'];

        $_SESSION['ltotal'] = $_SESSION['lfin']+$_SESSION['lpfin']+$_SESSION['lpneu']+$_SESSION['lautre'];
        // echo "Total Loyers : " . array_sum($total) . "\n";
        // print_r("Loyer Total = ". $total. "€");

        // $total = $_SESSION['ltotal'];

        // echo "Loyer Pneu = ". $_SESSION['lpneu']; //retrieve data
        // $vehicule->loyer_total = $_POST['ltotal'];

        if ($vehicule->createVehicule()) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Nouveau vehicule enregistré!</strong>  <a href="./pages/vehicules.php">Voir les vehicules</a>.
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Erreur lors de la création!</strong>
            </div>
            <?php
        }
    }
    ?>
    <form method="post" action="ajouter_vehicule.php" enctype="multipart/form-data">

      <div class="form-group">
        <label for="idvh">ID VEH</label>
        <input type="text" class="form-control" name="immatriculation">
      </div>

      <div class="form-group">
        <label for="nocontrat">N°contrat</label>
        <input type="text" class="form-control" name="nocontrat">
      </div>

   <!--    <label>Prestataire location:<br></label>
      <select class="form-control" id="loueur" name="loueur">
        <option id="loueur" value="">Sélectionnez un loueur</option>
      </select> -->

    <!--   <select class="form-control" id="loueur" name="loueur">
          <option id="loueur" value="{id}">{rsociale}</option>
        </select> -->
<!--
      <?php
      $loueur->setLoueur();
      ?> -->

      <?php
      $vehicule->setJSON();
       ?>

       <?php
       $vehicule->setDropdown();
        ?>

      <br />

      <div class="form-group">
        <label for="vachat">Valeur d'achat</label>
        <input type="text" class="form-control" name="vachat">
      </div>

      <div class="form-group">
        <label for="pcirc">Date circulation</label>
        <input type="date" class="form-control" name="circulation">
      </div>

      <div class="form-group">
        <label for="entree">Entrée parc</label>
        <input type="date" class="form-control" name="entree">
      </div>

      <div class="form-group">
        <label for="sortie">Sortie parc</label>
        <input type="date" class="form-control" name="sortie">
      </div>

      <?php
        $vehicule->setCategorieVeh();
      ?>

      <!-- <label>Marque: <br></label>
      <select class="form-control" id="makes" name="makes">
        <option id="makes" value="">Sélectionnez une marque de véhicule</option>
      </select>
      <br /> -->

      <?php
      $vehicule->setMakers();
       ?>

      <!-- <div id="cbmw">
      <select class="form-control" id="bmw" name="modele">
        <option id="bmw" value="">Sélectionnez un modèle BMW</option>
      </select>
      </div>

      <div id="caudi">
      <select class="form-control" id="audi" name="modele">
        <option id="audi" value="">Sélectionnez un modèle Audi</option>
      </select>
     </div> -->
     <div class="form-group">
       <label for="version">BMW</label>
       <input type="text" class="form-control" name="modele">
     </div>

      <div class="form-group">
        <label for="version">Version</label>
        <input type="text" class="form-control" name="version">
      </div>

      <div class="form-group">
        <label for="nchassis">N°chassis</label>
        <input type="text" class="form-control" name="nochassis">
      </div>

       <div class="form-group">
        <label for="bvitesse">Sélectionnez la boite de vitesse</label>
        <select class="form-control" id="sel1" name="bvitesse">
          <option selected>Automatique</option>
          <option>Manuelle</option>
        </select>
      </div>

      <div class="form-group">
        <label for="chevaux">Puissance fiscale (ch)</label>
        <input type="text" class="form-control" name="chevaux">
      </div>

      <div class="form-group">
        <label for="km">Kilomètrage</label>
        <input type="text" class="form-control" name="km">
      </div>

      <div class="form-group">
        <label for="portes">Nombre de portes</label>
        <input type="number" min="2" class="form-control" name="portes">
      </div>

      <div class="form-group">
        <label for="places">Nombre de places</label>
        <input type="number" min="2" class="form-control" name="places">
      </div>

      <div class="form-group">
        <label for="reservoir">Reservoir</label>
        <input type="text" class="form-control" name="reservoir">
      </div>

      <?php
        $vehicule->setCarburant();
      ?>

      <div class="form-group">
        <label for="consomixte">Consommation mixte</label>
        <input type="text" class="form-control" name="conso_mixte">
      </div>

      <div class="form-group">
        <label for="co2">Quantité CO2</label>
        <input type="text" class="form-control" name="co2">
      </div>

      <?php
        $vehicule->setDetention();
      ?>

      <div class="form-group">
        <label for="lfin">Loyer financier</label>
        <input type="text" class="form-control" name="lfin">
      </div>
      <!-- <?php $var_value = $_GET['lfin'];?> -->

      <div class="form-group">
        <label for="lpfin">Loyer perte financière</label>
        <input type="text" class="form-control" name="lpfin">
      </div>

      <div class="form-group">
        <label for="lpneu">Loyer pneu</label>
        <input type="text" class="form-control" name="lpneu">
      </div>

      <div class="form-group">
        <label for="lautre">Loyer autre</label>
        <input type="text" class="form-control" name="lautre">
      </div>

      <!-- <div class="form-group">
        <label for="ltotal">Loyer total</label>
        <input type="text" class="form-control" name="ltotal">
      </div> -->

      <div class="form-group">
        <label for="commentaire">Commentaire</label>
        <textarea class="form-control" rows="3" name="commentaire"></textarea>
      </div>

      <button type="submit" class="btn btn-success">Envoyer</button>
    </form>
    <?php
   var_dump($_POST);
   ?>

  </div>
  <script src="./public/js/jquery.min.js"></script>
  <script src="./public/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

  <script>
    if (!Modernizr.inputtypes.date) {
    $('input[type=date]').datepicker({
        // Consistent format with the HTML5 picker
        dateFormat: 'yy-mm-dd'
    });
}
  </script>

  <!--Webservice feature-->
  <!-- <script src="./public/js/vehicule_service.js"></script> -->
  <!-- <script src="./public/js/renters_service.js"></script> -->
  <script src="./public/js/selectbox.js"></script>

</body>
</html>
