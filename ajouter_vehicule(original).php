<?php
include_once './app/Database.php';

//Set new connection
$database = new Database();
$db = $database->getConnection();

include_once './app/Vehicule.php';
$vehicule = new Vehicule($db);

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
        $vehicule->categorie = $_POST['categorie'];
        $vehicule->marque = $_POST['makes'];
        $vehicule->modele = $_POST['modele'];
        $vehicule->version = $_POST['version'];
        $vehicule->no_chassis = $_POST['nochassis'];
        // $vehicule->boite_vitesse = $_POST['bvitesse'];
        // $vehicule->puissance_fiscale = $_POST['pfisc'];
        // $vehicule->km = $_POST['km'];
        // $vehicule->portes = $_POST['portes'];
        // $vehicule->places = $_POST['places'];
        // $vehicule->reservoir = $_POST['reservoir'];
        // $vehicule->carburant = $_POST['carburant'];
        // $vehicule->consomixte = $_POST['consomixte'];
        // $vehicule->co2 = $_POST['co2'];
        // $vehicule->detention = $_POST['detention'];
        // $vehicule->loyer_financier = $_POST['lfin'];
        // $vehicule->loyer_p_financier = $_POST['lpfin'];
        // $vehicule->loyer_pneu = $_POST['lpneu'];
        // $vehicule->loyer_autre = $_POST['lautre'];
        // $vehicule->loyer_total = $_POST['ltotal'];
        $vehicule->commentaire = $_POST['commentaire'];


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

      <!-- <div class="form-group">
        <label for="loueur">Sélectionnez la société de location</label>
        <select class="form-control" id="sel1" name="loueur">
          <option>LEASEPLAN</option>
          <option>ALPHABET</option>
          <option>AUTRE</option>
        </select>
      </div> -->

      <label>Prestataire location:<br></label>
      <select class="form-control" id="loueur" name="loueur">
        <option id="loueur" value="">Sélectionnez un loueur</option>
      </select>

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

      <div class="form-group">
        <label for="cat">Sélectionnez la categorie véhicule</label>
        <select class="form-control" id="sel1" name="categorie">
          <option>VP</option>
          <option>VU</option>
          <option selected>VI</option>
        </select>
      </div>

      <label>Marque: <br></label>
      <select class="form-control" id="makes" name="makes">
        <option id="makes" value="">Sélectionnez une marque de véhicule</option>
      </select>
      <br />

      <div id="cbmw">
      <select class="form-control" id="bmw" name="modele">
        <option id="bmw" value="">Sélectionnez un modèle BMW</option>
      </select>
      </div>

      <div id="caudi">
      <select class="form-control" id="audi" name="modele">
        <option id="audi" value="">Sélectionnez un modèle Audi</option>
      </select>
     </div>

     <br>

      <div class="form-group">
        <label for="version">Version</label>
        <input type="text" class="form-control" name="version">
      </div>

      <div class="form-group">
        <label for="nchassis">N°chassis</label>
        <input type="text" class="form-control" name="nochassis">
      </div>

      <!-- <div class="form-group">
        <label for="bvitesse">Sélectionnez la boite de vitesse</label>
        <select class="form-control" id="sel1" name="bvitesse">
          <option selected>Automatique</option>
          <option>Manuelle</option>
        </select>
      </div>

      <div class="form-group">
        <label for="pfisc">Puissance fiscale (ch)</label>
        <input type="text" class="form-control" name="pfisc">
      </div>

      <div class="form-group">
        <label for="km">KM</label>
        <input type="text" class="form-control" name="km">
      </div>

      <div class="form-group">
        <label for="portes">Nombre de portes</label>
        <input type="text" class="form-control" name="portes">
      </div>

      <div class="form-group">
        <label for="places">Nombre de places</label>
        <input type="text" class="form-control" name="places">
      </div>

      <div class="form-group">
        <label for="reservoir">Reservoir</label>
        <input type="text" class="form-control" name="reservoir">
      </div>

      <div class="form-group">
        <label for="carburant">Sélectionnez le carburant</label>
        <select class="form-control" id="sel1" name="carburant">
          <option selected>Diesel</option>
          <option>Essence</option>
          <option>Autre</option>
        </select>
      </div>

      <div class="form-group">
        <label for="consomixte">Consommation mixte</label>
        <input type="text" class="form-control" name="consomixte">
      </div>

      <div class="form-group">
        <label for="co2">Quantité CO2</label>
        <input type="text" class="form-control" name="co2">
      </div>

      <div class="form-group">
        <label for="detention">Sélectionnez la detention</label>
        <select class="form-control" id="sel1" name="detention">
          <option>Achat</option>
          <option>LCD</option>
          <option selected>LLD</option>
        </select>
      </div>

      <div class="form-group">
        <label for="lfin">Loyer financier</label>
        <input type="text" class="form-control" name="lfin">
      </div>

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

      <div class="form-group">
        <label for="ltotal">Loyer total</label>
        <input type="text" class="form-control" name="ltotal">
      </div> -->

      <div class="form-group">
        <label for="commentaire">Commentaire</label>
        <textarea class="form-control" rows="3" name="commentaire"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Envoyer</button>
    </form>
  </div>
  <script src="./public/js/jquery.min.js"></script>
  <script src="./public/js/bootstrap.min.js"></script>

  <!--Webservice feature-->
  <script src="./public/js/vehicule_service.js"></script>
  <script src="./public/js/renters_service.js"></script>
  <script src="./public/js/selectbox.js"></script>

</body>
</html>
