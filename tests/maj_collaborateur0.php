<?php
include_once 'includes/config.php';

// $id = isset($_GET['id']) ? $_GET['id'] : die('Erreur avec l\'ID RH Collaborateur');
// $id = isset($_GET['id']) ? $_GET['id'] : die('Need Product ID');
// var_dump($id);
$id = isset($_GET['id']) ? $_GET['id'] : die('Problème avec ID RH Collaborateur');

$database = new Connection();
$db = $database->getConnection();

include_once 'includes/collaborateur.inc.php';
$collaborateur = new Collaborateur($db);

$collaborateur->id= $id;
$collaborateur->readCollaborateurID();

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mettre à jour collaborateur</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>
  <body>
  <p><br/></p>
    <div class="container">
      <p>
	<a class="btn btn-primary" href="collaborateurs.php" role="button">Retour</a>
      </p><br/>
<?php
if($_POST){

	$collaborateur->idmatrh = $_POST['idrh'];
	$collaborateur->nom = $_POST['nom'];
	$collaborateur->prenom = $_POST['prenom'];
	$collaborateur->adresse = $_POST['adresse'];
  $collaborateur->codepostal = $_POST['codepostal'];
	$collaborateur->ville = $_POST['ville'];
	$collaborateur->telephone = $_POST['telephone'];
	$collaborateur->profession = $_POST['profession'];
  $collaborateur->justificatif = $_POST['justificatif'];
	$collaborateur->avantage = $_POST['avantage'];
	$collaborateur->date_entree = $_POST['date_entree'];
	$collaborateur->date_sortie = $_POST['date_sortie'];
  $collaborateur->commentaire = $_POST['commentaire'];

	if($collaborateur->updateCollaborateur()){
?>
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Mise à jour réussi!</strong> <a href="collaborateurs.php">Voir les collaborateurs</a>.
</div>
<!-- <script>window.location.href='collaborateurs.php'</script> -->
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
<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="idrh">ID RH</label>
    <input type="text" class="form-control" id="idrh" name="idrh" value='<?php echo $collaborateur->idmatrh; ?>'>
  </div>
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" value='<?php echo $collaborateur->nom; ?>'>
  </div>
  <div class="form-group">
    <label for="prenom">Prenom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" value='<?php echo $collaborateur->prenom; ?>'>
  </div>
  <div class="form-group">
    <label for="adresse">Adresse</label>
    <textarea class="form-control" rows="3" id="adresse" name="adresse" value=''><?php echo $collaborateur->adresse; ?>'</textarea>
  </div>
  <div class="form-group">
    <label for="codepostal">Code postal</label>
    <input type="text" class="form-control" id="codepostal" name="codepostal" value='<?php echo $collaborateur->codepostal; ?>'>
  </div>
  <div class="form-group">
    <label for="ville">Ville</label>
    <input type="text" class="form-control" id="ville" name="ville" value='<?php echo $collaborateur->ville; ?>'>
  </div>
  <div class="form-group">
    <label for="telephone">Téléphone</label>
    <input type="tel" class="form-control" id="telephone" name="telephone" value='<?php echo $collaborateur->telephone; ?>'>
  </div>

  <div class="form-group">
    <label for="profession">Sélectionnez la profession Biocodex</label>
    <select class="form-control" id="sel1" name="profession" value=''>
      <option>AR</option>
      <option>ARS</option>
      <option>APM</option>
    </select>
  </div>

  <div class="form-group" style="position:relative;">
    <label for="justificatif">Justificatif conducteur</label>
    <a class='btn btn-primary' href='javascript:;'>
      Sélectionnez un fichier
      <input type="file" name="justificatif" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="50"  onchange='$("#upload-file-info").html($(this).val());'>
    </a>
    &nbsp;
    <span class='label label-info' id="upload-file-info"></span>
  </div>

  <div class="form-group">
    <label for="avantage">Avantages financiers</label>
    <input type="text" class="form-control" id="avantage" name="avantage" value='<?php echo $collaborateur->avantage; ?>'>
  </div>

  <div class="form-group">
    <label for="date_entree">Début du contrat</label>
    <input type="date" class="form-control" id="date_entree" name="date_entree" value='<?php echo $collaborateur->date_entree; ?>'>
  </div>
  <div class="form-group">
    <label for="date_sortie">date_sortie</label>
    <input type="date" class="form-control" id="date_sortie" name="date_sortie" value='<?php echo $collaborateur->date_sortie; ?>'>
  </div>

  <div class="form-group">
    <label for="commentaire">Commentaire</label>
    <textarea class="form-control" rows="3" id="commentaire" name="commentaire" value='<?php echo $collaborateur->commentaire; ?>'></textarea>
  </div>

  <button type="submit" class="btn btn-success">Mettre à jour</button>
</form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
