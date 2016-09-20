<?php
include_once './app/Database.php';

$id = isset($_GET['id']) ? $_GET['id'] : die('Need Product ID');

$database = new Database();
$db = $database->getConnection();

include_once './app/Contrat.php';
$contrat = new Contrat($db);

$contrat->id = $id;
$contrat->readContratID();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorial-06</title>
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/views.css" rel="stylesheet">


      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>
  <body>
  <p><br/></p>
    <div class="container">
      <p>
	<a class="btn btn-primary" href="./pages/contrats.php" role="button">Retour</a>
      </p><br/>

<legend><h2>Détails du contrat: </h2></legend>

<form method="post">

  <div class="form-group">
    <label for="contrat">N°contrat: </label>
    <?php echo $contrat->ref_contrat; ?>
  </div>

<!-- <div class="form-group">
  <label for="veh">Sélectionnez une immatricule</label>
  <select class="form-control" id="sel1" name="veh" value=''>
    <option></option>
    <option></option>
  </select>
</div>

<div class="form-group">
  <label for="rh">Sélectionnez une matricule</label>
  <select class="form-control" id="sel1" name="rh">
    <option></option>
    <option></option>
    <option></option>
  </select>
</div>

<div class="form-group">
  <label for="collabs">Sélectionnez un collaborateur</label>
  <select class="form-control" id="sel1" name="collabs" value=''>
    <option></option>
    <option></option>
    <option></option>
  </select>
</div>

<div class="form-group">
  <label for="vehicules">Sélectionnez un véhicule</label>
  <select class="form-control" id="sel1" name="vehicules" value=''>
    <option></option>
    <option></option>
    <option></option>
  </select>
</div>

<div class="form-group">
  <label for="fact">Début contrat</label>
  <input type="date" class="form-control" name="debut">
</div>

<div class="form-group">
  <label for="fact">Fin contrat</label>
  <input type="date" class="form-control" name="fin">
</div>

  <div class="form-group">
    <label for="franchise">Valeur franchise</label>
    <input type="text" class="form-control" name="franchise">
  </div>

  <div class="form-group">
    <label for="nbacc">Nombre d'accidents</label>
    <input type="text" class="form-control" name="nbacc">
  </div>

  <div class="form-group">
    <label for="pfranchise">Franchise</label>
    <input type="text" class="form-control" name="pfranchise">
  </div>

  <div class="form-group">
    <label for="dfranchise">Franchise 2</label>
    <input type="text" class="form-control" name="dfranchise">
  </div>

  <div class="form-group">
    <label for="tfranchise">Franchise 3</label>
    <input type="text" class="form-control" name="tfranchise">
  </div>

  <div class="form-group">
    <label for="qfranchise">Franchise 4</label>
    <input type="text" class="form-control" name="qfranchise">
  </div> -->

  <!-- <div class="form-group">
    <label for="commentaire">Commentaire: </label>
    <?php echo $contrat->commentaire; ?>
  </div> -->

</form>
    </div>

    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>

  </body>
</html>
