<?php
include_once './app/Database.php';

// $id = isset($_GET['id']) ? ($_GET['id']) : die('Erreur avec l\'ID RH Collaborateur');
$id = isset($_GET['id']) ? $_GET['id'] : die('Problème Collaborateur ID');

$database = new Database();
$db = $database->getConnection();

include_once './app/Collaborateur.php';
$collaborateur = new Collaborateur($db);

include_once './app/File.php';
$file = new File($db);

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

      <legend><h2>Fiche collaborateur n° <strong><?php echo $collaborateur->matriculerh; ?></strong></h2></legend>

<form method="post">

  <div class="form-group">
    <label for="idrh">Matricule RH: </label>
    <?php echo $collaborateur->matriculerh; ?>
  </div>

  <div class="form-group">
    <label for="nom">Nom: </label>
    <?php echo $collaborateur->nom; ?>
  </div>

  <div class="form-group">
    <label for="prenom">Prénom: </label>
    <?php echo $collaborateur->prenom; ?>'
  </div>

  <div class="form-group">
    <label for="adresse">Adresse: </label>
    <?php echo $collaborateur->adresse; ?>
  </div>

  <div class="form-group">
    <label for="cp">Code postal: </label>
    <?php echo $collaborateur->cp; ?>
  </div>

  <div class="form-group">
    <label for="ville">Ville: </label>
    <?php echo $collaborateur->ville; ?>
  </div>

  <div class="form-group">
    <label for="tel">Téléphone: </label>
    <?php echo $collaborateur->tel; ?>
  </div>

  <div class="form-group">
    <label for="catpro">Catégorie professionnelle: </label>
    <?php echo $collaborateur->categorie_pro; ?>
  </div>

  <div class="form-group">
    <label for="file">PJ: </label>
    <?php echo $file->fp; ?>
  </div>

  <div class="form-group">
    <label for="avantage">Avantages naturels: </label>
    <?php echo $collaborateur->avantage . ' €'; ?>
  </div>

  <div class="form-group">
    <label for="entree">Date entrée: </label>
    <?php echo $collaborateur->date_entree; ?>
  </div>

  <div class="form-group">
    <label for="sortie">Date sortie: </label>
    <?php echo $collaborateur->date_sortie; ?>
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
