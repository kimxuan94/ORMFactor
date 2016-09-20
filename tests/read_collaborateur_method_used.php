<?php
include_once './app/Database.php';

// $id = isset($_GET['id']) ? ($_GET['id']) : die('Erreur avec l\'ID RH Collaborateur');
$id = isset($_GET['id']) ? $_GET['id'] : die('Problème Collaborateur ID');

$database = new Database();
$db = $database->getConnection();

include_once './app/Collaborateur.php';
$collaborateur = new Collaborateur($db);

$collaborateur->id = $id;
$collaborateur->readCollaborateurID();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voir un collaborateur</title>
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/views.css" rel="stylesheet">


      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>
  <body>
  <p><br/></p>
    <div class="container">
      <p>
	<a class="btn btn-primary" href="./pages/collaborateurs.php" role="button">Retour</a>
      </p><br/>

      <legend><h2>Fiche collaborateur:</h2></legend>

<form method="post">

  <div class="form-group">
    <label for="idrh">Matricule RH: </label>
    <?php echo $collaborateur->getMatriculeRH(); ?>
  </div>

  <div class="form-group">
    <label for="nom">Nom: </label>
    <?php echo $collaborateur->getNom(); ?>
  </div>

  <div class="form-group">
    <label for="prenom">Prénom: </label>
    <?php echo $collaborateur->getPrenom(); ?>'
  </div>

  <div class="form-group">
    <label for="adresse">Adresse: </label>
    <?php echo $collaborateur->getAdresse(); ?>
  </div>

  <div class="form-group">
    <label for="cp">Code postal: </label>
    <?php echo $collaborateur->getCP(); ?>
  </div>

  <div class="form-group">
    <label for="ville">Ville: </label>
    <?php echo $collaborateur->getVille(); ?>
  </div>

  <div class="form-group">
    <label for="tel">Téléphone: </label>
    <?php echo $collaborateur->getTel(); ?>
  </div>

  <!-- <div class="form-group">
    <label for="prof">Profession Phardex</label>
    <select name="prof" id="prof" class="form-control">
      <option>AR</option>
      <option>ARS</option>
      <option>APM</option>
    </select>
  </div>

  <div class="form-group" style="position:relative;">
    <label for="justificatif">Justificatif conducteur</label>
    <a class='btn btn-primary' href='javascript:;'>
      Sélectionnez un fichier
      <input type="file" name="justif" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="50"  onchange='$("#upload-file-info").html($(this).val());'>
    </a>
    &nbsp;
    <span class='label label-info' id="upload-file-info"></span>
  </div> -->

  <div class="form-group">
    <label for="avantage">Avantages naturels: </label>
    <?php echo $collaborateur->avantage . ' €'; ?>
  </div>

  <div class="form-group">
    <label for="entree">Date entrée: </label>
    <?php echo $collaborateur->getDateEntree(); ?>
  </div>

  <div class="form-group">
    <label for="sortie">Date sortie: </label>
    <?php echo $collaborateur->getDateSortie(); ?>
  </div>

  <div class="form-group">
    <label for="commentaire">Commentaire: </label><br>
    <?php echo $collaborateur->commentaire; ?>
  </div>
</form>
    </div>

    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>

  </body>
</html>
