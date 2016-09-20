<?php
include_once './app/Database.php';

// Set new connection
$database = new Database();
$db = $database->getConnection();

include_once './app/Collaborateur.php';
$collaborateur = new Collaborateur($db);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer un collaborateur</title>

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
        <a class="btn btn-primary" href="./pages/collaborateurs.php" role="button">Retour</a>
    </p><br/>
    <?php
    if ($_POST) {

        $collaborateur->matriculerh = $_POST['matriculerh'];
        $collaborateur->nom = $_POST['nom'];
        $collaborateur->prenom = $_POST['prenom'];
        $collaborateur->adresse = $_POST['adresse'];
        $collaborateur->cp = $_POST['cp'];
        $collaborateur->ville = $_POST['ville'];
        $collaborateur->tel = $_POST['tel'];
        $collaborateur->avantage = $_POST['avantage_nature'];
        $collaborateur->date_entree = $_POST['date_entree'];
        $collaborateur->date_sortie = $_POST['date_sortie'];
        $collaborateur->commentaire = $_POST['commentaire'];

        if ($collaborateur->createCollaborateur()) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Nouveau collaborateur enregistré!</strong>  <a href="./pages/collaborateurs.php">Voir les collaborateurs</a>.
            </div>
            <?php
        }

        // elseif {
          //Test
          $errors = [];

          // $database = new Database();
          // $db = $database->getConnection();

          // $collaborateur = new Collaborateur();

          if(empty($_POST['matriculerh']) || $_POST['matriculerh'] == ''){
          	$errors['matriculerh'] = " Vous n'avez pas renseigné votre matricule";
          }
          if(empty($_POST['nom']) || $_POST['nom'] == ''){
          	$errors['nom'] = " Vous n'avez pas renseigné votre nom";
          }
          if(empty($_POST['prenom']) || $_POST['prenom'] == ''){
          	$errors['prenom'] = " Vous n'avez pas renseigné votre prénom";
          }
          if(empty($_POST['adresse']) || $_POST['adresse'] == ''){
          	$errors['adresse'] = " Vous n'avez pas renseigné une adresse valide ";
          }
          if(empty($_POST['cp']) || $_POST['cp'] == ''){
          	$errors['cp'] = " Vous n'avez pas renseigné de code postal valide ";
          }
          if(empty($_POST['ville']) || $_POST['ville'] == ''){
          	$errors['ville'] = " Vous n'avez pas renseigné de ville valide ";
          }
          if(empty($_POST['tel']) || $_POST['tel'] == ''){
          	$errors['tel'] = " Vous n'avez pas renseigné de numero valide ";
          }
          if(empty($_POST['avantage_nature']) || $_POST['avantage_nature'] == ''){
          	$errors['avantage_nature'] = " Vous n'avez pas renseigné de montant valide ";
          }
          if(empty($_POST['date_entree']) || $_POST['date_entree'] == ''){
          	$errors['date_entree'] = " Vous n'avez pas renseigné de date valide";
          }
          if(empty($_POST['date_sortie']) || $_POST['date_sortie'] == ''){
          	$errors['date_sortie'] = " Vous n'avez pas renseigné de date valide";
          }
          if(empty($_POST['commentaire']) || $_POST['commentaire'] == ''){
          	$errors['commentaire'] = " Votre commentaire contient des caractères interdits";
          }

          if(!empty($errors)){
          	$_SESSION['errors'] = $errors;
          	$_SESSION['inputs'] = $_POST;
          	header('Location: ./pages/collaborateurs.php');
          } else {

          	$collab = [
          		'matriculerh' => $_POST['matriculerh'],
              'nom' => $_POST['nom'],
          		'prenom' => $_POST['prenom'],
          		'adresse' => $_POST['adresse'],
          		'cp' => $_POST['cp'],
              'ville' => $_POST['ville'],
              'tel' => $_POST['tel'],
              'avantages' => $_POST['avantage_nature'],
              'date_entree' => $_POST['date_entree'],
              'date_sortie' => $_POST['date_sortie'],
              'commentaire' => $_POST['commentaire']
          	];

            $collaborateur->createCollaborateur($collab);
          }
    //     // else {
    //     //     ?>
    <!-- //          <div class="alert alert-danger alert-dismissible" role="alert">
    //            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
    //                   aria-hidden="true">&times;</span></button>
    //           <strong>Erreur lors de la création!</strong>
    //        </div> -->
    //        <?php
    //     // }
    }
    // ?>
    <form method="post" action="ajouter_collaborateur.php" enctype="multipart/form-data">
      <div class="form-group">

        <div class="control-group <?php echo !empty($errors['matriculerh'])?'error':'';?>">
        <label for="idrh">Matricule RH</label>
        <input type="text" class="form-control" name="matriculerh" value="<?php echo !empty($collaborateur->matriculerh)?$collaborateur->matriculerh:'';?>">
        <?php if (!empty($errors['matriculerh'])): ?>
             <span class="help-inline"><?php echo $errors['matriculerh'];?></span>
         <?php endif; ?>
      </div>

      <div class="control-group <?php echo !empty($errors['matriculerh'])?'error':'';?>">
      <label for="idrh" class="control-label">Matricule RH</label>
	     <div class="controls">
        <input type="text" class="form-control" name="matriculerh" placeholder="Matricule RH" value="<?php echo !empty($collaborateur->matriculerh)?$collaborateur->matriculerh:'';?>">
        <?php if (!empty($errors['matriculerh'])): ?>
            <span class="help-inline"><?php echo $errors['matriculerh'];?></span>
        <?php endif; ?>
	     </div>
     </div><br />

      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" name="nom">
      </div>

      <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" name="prenom">
      </div>

      <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" name="adresse">
      </div>

      <div class="form-group">
        <label for="cp">Code postal</label>
        <input type="text" class="form-control" name="cp">
      </div>

      <div class="form-group">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" name="ville">
      </div>

      <div class="form-group">
        <label for="tel">Téléphone</label>
        <input type="text" class="form-control" name="tel">
      </div>

      <!-- <div class="form-group">
        <label for="prof">Profession Phardex</label>
        <select name="prof" class="form-control">
          <option>AR</option>
          <option>ARS</option>
          <option>APM</option>
        </select>
      </div>

      <div class="form-group" style="position:relative;">
        <label for="justif">Justificatif conducteur</label>
        <a class='btn btn-primary' href='javascript:;'>
          Sélectionnez un fichier
          <input type="file" name="justif" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="50"  onchange='$("#upload-file-info").html($(this).val());'>
        </a>
        &nbsp;
        <span class='label label-info' id="upload-file-info"></span>
      </div> -->

      <div class="form-group">
        <label for="avantage">Avantages naturels</label>
        <input type="text" class="form-control" name="avantage_nature">
      </div>

      <div class="form-group">
        <label for="entree">Date entrée</label>
        <input type="text" class="form-control" name="date_entree">
      </div>

      <div class="form-group">
        <label for="sortie">Date sortie</label>
        <input type="text" class="form-control" name="date_sortie">
      </div>

      <div class="form-group">
        <label for="commentaire">Commentaire</label>
        <textarea class="form-control" rows="3" name="commentaire"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Envoyer</button>
    </form>
  </div>
  <script src="./public/js/jquery.min.js"></script>
<script src="./public/js/bootstrap.min.js"></script>
</body>
</html>
