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
<?php
if($_POST){

	$frais->no_poste = $_POST['pfrais'];
	$frais->reparation = $_POST['repar'];
	$frais->gardiennage = $_POST['gard'];
	$frais->remplacement = $_POST['remp'];
  $frais->remise_neuf = $_POST['rneuf'];
	$frais->commentaire = $_POST['commentaire'];

	if($frais->updateFrais()){
?>
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Mise à jour réussi!</strong> <a href="./pages/frais.php">Voir les frais</a>.
</div>
<!-- <script>window.location.href='frais.php'</script> -->
<?php
	}else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Erreur lors de la mise à jour!</strong>
</div>
<?php
	}
}
?>
<form method="post">
  <div class="form-group">
    <label for="pfrais">Poste de frais</label>
    <input type="text" class="form-control" id="pfrais" name="pfrais" value='<?php echo $frais->no_poste; ?>' readonly>
  </div>
  <div class="form-group">
    <label for="repar">Réparation</label>
    <input type="text" class="form-control" id="repar" name="repar" value='<?php echo $frais->reparation; ?>'>
  </div>
  <div class="form-group">
    <label for="gard">Gardiennage</label>
    <input type="text" class="form-control" id="gard" name="gard" value='<?php echo $frais->gardiennage; ?>'>
  </div>
  <div class="form-group">
    <label for="remp">Remplacement</label>
    <input type="text" class="form-control" id="remp" name="remp" value='<?php echo $frais->remplacement; ?>'>
  </div>
  <div class="form-group">
    <label for="rneuf">Remise à neuf</label>
    <input type="text" class="form-control" id="rneuf" name="rneuf" value='<?php echo $frais->remise_neuf; ?>'>
  </div>

  <div class="form-group">
    <label for="commentaire">Commentaire</label>
    <textarea class="form-control" rows="3" id="commentaire" name="commentaire" value='<?php echo $frais->commentaire; ?>'></textarea>
  </div>

  <button type="submit" class="btn btn-success">Mettre à jour</button>
</form>
    </div>

    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>

  </body>
</html>
