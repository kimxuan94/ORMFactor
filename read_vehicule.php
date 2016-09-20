<?php
session_set_cookie_params(0, "/"); 
session_start();

include_once './app/Database.php';

// $id = isset($_GET['id']) ? ($_GET['id']) : die('Erreur avec l\'ID RH Collaborateur');
$id = isset($_GET['id']) ? $_GET['id'] : die('Problème avec Vehicule ID');

$database = new Database();
$db = $database->getConnection();

include_once './app/Vehicule.php';
$vehicule = new Vehicule($db);

$vehicule->id = $id;
$vehicule->readVehiculeID();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mettre à jour véhicule</title>
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/views.css" rel="stylesheet">


      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>
  <body>
  <p><br/></p>
    <div class="container">
      <p>
	<a class="btn btn-primary" href="./pages/vehicules.php" role="button">Retour</a>
      </p><br/>

<legend><h2>Fiche du véhicule <strong><?php echo $vehicule->immatriculation; ?></strong></h2></legend>

<form method="post">
  <div class="form-group">
    <label for="idvh">Immatriculation: </label>
    <?php echo $vehicule->immatriculation; ?>
  </div>

  <div class="form-group">
    <label for="nocontrat">N°contrat: </label>
    <?php echo $vehicule->no_contrat; ?>
  </div>

  <div class="form-group">
    <label for="loueur">Société de location: </label>
    <?php echo $vehicule->loueur; ?>
  </div>

  <div class="form-group">
    <label for="vachat">Valeur d'achat: </label>
    <?php echo $vehicule->valeur_achat . ' €'; ?>
  </div>

  <div class="form-group">
    <label for="pcirc">Date de circulation: </label>
    <?php echo $vehicule->date_circulation; ?>
  </div>

  <div class="form-group">
    <label for="entree">Date d'entrée parc: </label>
    <?php echo $vehicule->date_entree_parc; ?>
  </div>

  <div class="form-group">
    <label for="sortie">Date de sortie parc: </label>
    <?php echo $vehicule->date_sortie; ?>
  </div>

  <div class="form-group">
    <label for="cat">Categorie véhicule:</label>
    <?php echo $vehicule->categorie_veh; ?>
  </div>

  <div class="form-group">
    <label for="marque">Marque</label>
    <?php echo $vehicule->marque; ?>
  </div>

  <div class="form-group">
    <label for="modele">Modèle: </label>
    <?php echo $vehicule->modele; ?>
  </div>

  <div class="form-group">
    <label for="version">Version: </label>
    <?php echo $vehicule->version; ?>
  </div>

  <div class="form-group">
    <label for="nchassis">N°chassis: </label>
    <?php echo $vehicule->no_chassis; ?>
  </div>

  <div class="form-group">
    <label for="bvitesse">Boite vitesse: </label>
    <?php echo $vehicule->boite_vitesse; ?>
  </div>

  <div class="form-group">
    <label for="chevaux">Puissance fiscale: </label>
    <?php echo $vehicule->chevaux; ?>
  </div>

  <div class="form-group">
    <label for="km">Km: </label>
    <?php echo $vehicule->km; ?>
  </div>

  <div class="form-group">
    <label for="portes">Portes: </label>
    <?php echo (string)$vehicule->portes; ?>
  </div>

  <div class="form-group">
    <label for="places">Places: </label>
    <?php echo (string)$vehicule->places; ?>
  </div>

  <div class="form-group">
    <label for="reservoir">Reservoir: </label>
    <?php echo $vehicule->reservoir; ?>
  </div>

  <div class="form-group">
    <label for="carburant">Carburant: </label>
    <?php echo $vehicule->carburant; ?>
  </div>

  <div class="form-group">
    <label for="conso_mixte">Consommation mixte: </label>
    <?php echo $vehicule->consommation_mixte; ?>
  </div>

  <div class="form-group">
    <label for="indice">Indice CO2: </label>
    <?php echo $vehicule->indice_co2; ?>
  </div>

  <div class="form-group">
    <label for="detention">Type détention: </label>
    <?php echo $vehicule->detention; ?>
  </div>


  <!-- <div class="form-group">
    <label for="bvitesse">Sélectionnez la boite de vitesse</label>
    <select class="form-control" id="sel1" name="bvitesse" value='<?php echo $vehicule->boite_vitesse; ?>'>
      <option selected>Automatique</option>
      <option>Manuelle</option>
    </select>
  </div>

  <div class="form-group">
    <label for="pfisc">Puissance fiscale (ch)</label>
    <input type="text" class="form-control" name="pfisc" value='<?php echo $vehicule->puissance_fiscale; ?>'>
  </div>

  <div class="form-group">
    <label for="km">KM</label>
    <input type="text" class="form-control" name="km" value='<?php echo $vehicule->km; ?>'>
  </div>

  <div class="form-group">
    <label for="portes">Nombre de portes</label>
    <input type="text" class="form-control" name="portes" value='<?php echo $vehicule->portes; ?>'>
  </div>

  <div class="form-group">
    <label for="places">Nombre de places</label>
    <input type="text" class="form-control" name="places" value='<?php echo $vehicule->places; ?>'>
  </div>

  <div class="form-group">
    <label for="reservoir">Reservoir</label>
    <input type="text" class="form-control" name="reservoir" value='<?php echo $vehicule->reservoir; ?>'>
  </div>

  <div class="form-group">
    <label for="carburant">Sélectionnez le carburant</label>
    <select class="form-control" id="sel1" name="carburant" value='<?php echo $vehicule->carburant; ?>'>
      <option selected>Diesel</option>
      <option>Essence</option>
      <option>Autre</option>
    </select>
  </div>

  <div class="form-group">
    <label for="consomixte">Consommation mixte</label>
    <input type="text" class="form-control" name="consomixte" value='<?php echo $vehicule->consomixte; ?>'>
  </div>

  <div class="form-group">
    <label for="co2">Quantité CO2</label>
    <input type="text" class="form-control" name="co2" value='<?php echo $vehicule->co2; ?>'>
  </div>

  <div class="form-group">
    <label for="detention">Sélectionnez la detention</label>
    <select class="form-control" id="sel1" name="detention" value='<?php echo $vehicule->detention; ?>'>
      <option>Achat</option>
      <option>LCD</option>
      <option selected>LLD</option>
    </select>
  </div>-->

  <div class="form-group">
    <label for="lfin">Loyer financier: </label>
    <?php echo $_SESSION['lfin']." €"; ?>
  </div>

  <div class="form-group">
    <label for="lpfin">Loyer perte financière: </label>
    <?php echo $_SESSION['lpfin']." €"; ?>
  </div>

  <div class="form-group">
    <label for="lpneu">Loyer pneu: </label>
    <?php echo $_SESSION['lpneu']." €"; ?>
  </div>

  <div class="form-group">
    <label for="lautre">Loyer autre: </label>
    <?php echo $_SESSION['lautre']." €"; ?>
  </div>

  <div class="form-group">
    <label for="ltotal">Total loyers: </label>
    <?php echo $_SESSION['ltotal']." €"; ?>
  </div>

  <div class="form-group">
    <label for="commentaire">Commentaire: </label>
    <?php echo $vehicule->commentaire; ?>
  </div>
</form>
    </div>

    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>

  </body>
</html>
