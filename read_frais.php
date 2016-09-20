<?php
include_once './app/Database.php';

// $id = isset($_GET['id']) ? ($_GET['id']) : die('Erreur avec l\'ID RH Collaborateur');
$id = isset($_GET['id']) ? $_GET['id'] : die('Problème Frais ID');

$database = new Database();
$db = $database->getConnection();

include_once './app/Frais.php';
$frais = new Frais($db);

$frais->id = $id;
$frais->readFraisID();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mettre à jour frais</title>
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/views.css" rel="stylesheet">


      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>
  <body>
  <p><br/></p>
    <div class="container">
      <p>
	<a class="btn btn-primary" href="./pages/frais.php" role="button">Retour</a>
      </p><br/>

<legend><h2>Détails des frais: </h2></legend>

<form method="post">
  <div class="form-group">
    <label for="pfrais">Poste de frais: </label>
    <?= $frais->no_poste; ?>
  </div>
  <div class="form-group">
    <label for="repar">Réparation: </label>
    <?php echo $frais->reparation . ' €'; ?>
  </div>
  <div class="form-group">
    <label for="gard">Gardiennage: </label>
    <?php echo $frais->gardiennage . ' €'; ?>
  </div>
  <div class="form-group">
    <label for="remp">Remplacement: </label>
    <?php echo $frais->remplacement . ' €'; ?>
  </div>
  <div class="form-group">
    <label for="rneuf">Remise à neuf: </label>
    <?php echo $frais->remise_neuf . ' €'; ?>
  </div>

  <div class="form-group">
    <label for="facturation">Date de facturation: </label>
    <?php echo $frais->date_facturation; ?>
  </div>

  <div class="form-group">
    <label for="commentaire">Commentaire: </label>
    <?php echo $frais->commentaire; ?>
  </div>

</form>
    </div>

    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>

  </body>
</html>
