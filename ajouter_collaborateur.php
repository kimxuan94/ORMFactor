<?php
include_once './app/Database.php';

// Set new connection
$database = new Database();
$db = $database->getConnection();

include_once './app/Collaborateur.php';
$collaborateur = new Collaborateur($db);

include_once './app/File.php';
$file = new File($db);
// include_once './app/Categorie.php';
// $categorie = new Categorie($db);
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
        <a class="btn btn-primary" href="./pages/collaborateurs.php" role="button">Retour</a>
    </p><br/>

    <!--Zone controle formulaire-->
    <?php
    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){

        $errors = [];

        $collaborateur->matriculerh = $_POST['matriculerh'];
        $collaborateur->nom = $_POST['nom'];
        $collaborateur->prenom = $_POST['prenom'];
        $collaborateur->adresse = $_POST['adresse'];
        $collaborateur->cp = $_POST['cp'];
        $collaborateur->ville = $_POST['ville'];
        $collaborateur->tel = $_POST['tel'];
        $collaborateur->categorie_pro = (string)$_POST['pro'];
        // $collaborateur->categorie_pro = $selectOption;
        $collaborateur->avantage = $_POST['avantage_nature'];
        $collaborateur->date_entree = $_POST['date_entree'];
        $collaborateur->date_sortie = $_POST['date_sortie'];
        $collaborateur->commentaire = $_POST['commentaire'];

        $file->fp = isset($_POST['file_source']);

        //Gestion erreur formulaire
        $valid = true;

        if(empty($_POST['matriculerh']) || $_POST['matriculerh'] == ''){
          $errors['matriculerh'] = " Vous n'avez pas renseigné votre matricule";
          $valid = false;
        }else if (!preg_match("/^\d{0,4}$/", $collaborateur->matriculerh)) {
        	$errors['matriculerh'] = 'Entrez un matricule à 4 chiffres';
        }

        if(empty($_POST['nom']) || $_POST['nom'] == ''){
          $errors['nom'] = " Vous n'avez pas renseigné de nom";
          $valid = false;
        }else if (!preg_match("/^[a-zA-Z ]*$/",$collaborateur->nom)) {
            $errors['nom'] = "Nom du collaborateur incorrect";
        }

        if(empty($_POST['prenom']) || $_POST['prenom'] == ''){
          $errors['prenom'] = " Vous n'avez pas renseigné de prénom";
          $valid = false;
        }else if (!preg_match("/^[a-zA-Z ]*$/",$collaborateur->prenom)) {
          $errors['prenom'] = "Prénom du collaborateur incorrect";
        }

        if(empty($_POST['adresse']) || $_POST['adresse'] == ''){
          $errors['adresse'] = " Vous n'avez pas renseigné une adresse valide ";
          $valid = false;
        }else if (!preg_match('/^[a-z0-9 .\-]+$/i', $collaborateur->adresse)) {
        	$errors['adresse'] = "Adresse de résidence incorrect";
        }

        if(empty($_POST['cp']) || $_POST['cp'] == ''){
          $errors['cp'] = " Vous n'avez pas renseigné de code postal valide ";
          $valid = false;
        }else if (!preg_match("/^\d{0,5}$/", $collaborateur->cp)) {
        	$errors['cp'] = "Code postal incorrect";
        }

        if(empty($_POST['ville']) || $_POST['ville'] == ''){
          $errors['ville'] = " Vous n'avez pas renseigné de ville valide ";
          $valid = false;
        }

        if(empty($_POST['tel']) || $_POST['tel'] == ''){
          $errors['tel'] = " Vous n'avez pas renseigné de numéro valide ";
          $valid = false;
        }else if (!preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $collaborateur->tel)){
        	$errors['tel'] = "Ce numéro de téléphone est invalide";
        }

        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0)
          {
              $tmpName  = $_FILES['image']['tmp_name'];

              $fp = fopen($tmpName, 'rb'); // read binary
          }


        if(!preg_match('/^[0-9]*(\.[0-9]+)?$/', $collaborateur->avantage)) {
          $errors['avantage_nature'] = " Vous n'avez pas renseigné de montant valide ";
        }

        if(empty($_POST['date_entree']) || $_POST['date_entree'] == '') {
          $errors['date_entree'] = " Vous n'avez pas renseigné de date ";
          $valid = false;
        }else if(!preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $collaborateur->date_entree))
          $errors['date_entree'] = " Vous avez renseigné une date invalide ";
        }

        if(empty($_POST['date_sortie']) || $_POST['date_sortie'] == '') {
          $errors['date_sortie'] = " Vous n'avez pas renseigné de date ";
          $valid = false;
        }else if(!preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $collaborateur->date_sortie)){
          $errors['date_sortie'] = " Vous avez renseigné une date invalide ";
        }

        if(!preg_match("/^[a-zA-Z ]*$/", $collaborateur->commentaire)) {
          $errors['commentaire'] = "Votre commentaire comporte des caractères interdits";
        }

        if($valid) {
        $collaborateur->createCollaborateur();
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Nouveau collaborateur enregistré!</strong>  <a href="./pages/collaborateurs.php">Voir les collaborateurs</a>.
            </div>
            <?php
        }
          else {
            ?>
              <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                       aria-hidden="true">&times;</span></button>
               <strong>Erreur lors de la création!</strong>
            </div>
            <?php
          }
    // ?>

      <form method="post" action="ajouter_collaborateur.php" enctype="multipart/form-data">
      <div class="form-group">

      <div class="control-group <?php echo !empty($errors['matriculerh'])?'error':'';?>">
      <label for="idrh" class="control-label">Matricule RH</label>
	     <div class="controls">
        <input type="text" class="form-control" name="matriculerh" placeholder="Matricule RH" value="<?php echo !empty($collaborateur->matriculerh)?$collaborateur->matriculerh:'';?>">
        <?php if (!empty($errors['matriculerh'])): ?>
            <span class="help-inline"><?php echo $errors['matriculerh'];?></span>
        <?php endif; ?>
	     </div>
     </div><br />

     <div class="control-group <?php echo !empty($errors['nom'])?'error':'';?>">
     <label for="nom" class="control-label">Nom</label>
      <div class="controls">
       <input type="text" class="form-control" name="nom" placeholder="Entrez un nom" value="<?php echo !empty($collaborateur->nom)?$collaborateur->nom:'';?>">
       <?php if (!empty($errors['nom'])): ?>
           <span class="help-inline"><?php echo $errors['nom'];?></span>
       <?php endif; ?>
      </div>
    </div><br />

    <div class="control-group <?php echo !empty($errors['prenom'])?'error':'';?>">
    <label for="prenom" class="control-label">Prénom</label>
     <div class="controls">
      <input type="text" class="form-control" name="prenom" placeholder="Entrez un prénom" value="<?php echo !empty($collaborateur->prenom)?$collaborateur->prenom:'';?>">
      <?php if (!empty($errors['prenom'])): ?>
          <span class="help-inline"><?php echo $errors['prenom'];?></span>
      <?php endif; ?>
     </div>
   </div><br />

   <div class="control-group <?php echo !empty($errors['adresse'])?'error':'';?>">
   <label for="adresse" class="control-label">Adresse</label>
    <div class="controls">
     <input type="text" class="form-control" name="adresse" placeholder="Entrez une adresse" value="<?php echo !empty($collaborateur->adresse)?$collaborateur->adresse:'';?>">
     <?php if (!empty($errors['adresse'])): ?>
         <span class="help-inline"><?php echo $errors['adresse'];?></span>
     <?php endif; ?>
    </div>
  </div><br />

  <div class="control-group <?php echo !empty($errors['cp'])?'error':'';?>">
  <label for="cp" class="control-label">Code postal</label>
   <div class="controls">
    <input type="text" class="form-control" name="cp" placeholder="Entrez un code postal" value="<?php echo !empty($collaborateur->cp)?$collaborateur->cp:'';?>">
    <?php if (!empty($errors['cp'])): ?>
        <span class="help-inline"><?php echo $errors['cp'];?></span>
    <?php endif; ?>
   </div>
 </div><br />

 <div class="control-group <?php echo !empty($errors['ville'])?'error':'';?>">
 <label for="cp" class="control-label">Ville</label>
  <div class="controls">
   <input type="text" class="form-control" name="ville" placeholder="Entrez une ville" value="<?php echo !empty($collaborateur->ville)?$collaborateur->ville:'';?>">
   <?php if (!empty($errors['ville'])): ?>
       <span class="help-inline"><?php echo $errors['ville'];?></span>
   <?php endif; ?>
  </div>
</div><br />


<div class="control-group <?php echo !empty($errors['tel'])?'error':'';?>">
<label for="cp" class="control-label">Téléphone</label>
 <div class="controls">
  <input type="text" class="form-control" name="tel" placeholder="Entrez un numéro de téléphone" value="<?php echo !empty($collaborateur->tel)?$collaborateur->tel:'';?>">
  <?php if (!empty($errors['tel'])): ?>
      <span class="help-inline"><?php echo $errors['tel'];?></span>
  <?php endif; ?>
 </div>
</div><br />

    <?php
    $collaborateur->setCategoriePro();
    ?>

      <div class="form-group" style="position:relative;">
        <label for="justif">Justificatif conducteur</label>
        <a class='btn btn-primary' href='javascript:;'>
          Sélectionnez un fichier
          <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="50"  onchange='$("#upload-file-info").html($(this).val());'>
        </a>
        &nbsp;
        <span class='label label-info' id="upload-file-info"></span>
      </div>



      <div class="control-group <?php echo !empty($errors['avantage_nature'])?'error':'';?>">
      <label for="avantage_nature" class="control-label">Avantages naturels</label>
       <div class="controls">
        <input type="text" class="form-control" name="avantage_nature" placeholder="Entrez un montant" value="<?php echo !empty($collaborateur->avantage)?$collaborateur->avantage:'';?>">
        <?php if (!empty($errors['avantage_nature'])): ?>
            <span class="help-inline"><?php echo $errors['avantage_nature'];?></span>
        <?php endif; ?>
       </div>
      </div><br />

      <div class="control-group <?php echo !empty($errors['date_entree'])?'error':'';?>">
      <label for="date_entree" class="control-label">Date d'entrée</label>
       <div class="controls">
        <input type="date" class="form-control" name="date_entree" placeholder="Entrez une date" value="<?php echo !empty($collaborateur->date_entree)?$collaborateur->date_entree:'';?>">
        <?php if (!empty($errors['date_entree'])): ?>
            <span class="help-inline"><?php echo $errors['date_entree'];?></span>
        <?php endif; ?>
       </div>
      </div><br />

      <div class="control-group <?php echo !empty($errors['date_sortie'])?'error':'';?>">
      <label for="date_sortie" class="control-label">Date de sortie</label>
       <div class="controls">
        <input type="date" class="form-control" name="date_sortie" placeholder="Entrez une date" value="<?php echo !empty($collaborateur->date_sortie)?$collaborateur->date_sortie:'';?>">
        <?php if (!empty($errors['date_sortie'])): ?>
            <span class="help-inline"><?php echo $errors['date_sortie'];?></span>
        <?php endif; ?>
       </div>
      </div><br />

      <div class="control-group <?php echo !empty($errors['commentaire'])?'error':'';?>">
      <label for="commentaire" class="control-label">Commentaire</label>
       <div class="controls">
        <textarea class="form-control" name="commentaire" placeholder="Entrez un commentaire" value="<?php echo !empty($collaborateur->commentaire)?$collaborateur->commentaire:'';?>"></textarea>
        <?php if (!empty($errors['commentaire'])): ?>
            <span class="help-inline"><?php echo $errors['commentaire'];?></span>
        <?php endif; ?>
       </div>
      </div><br />
      <button type="submit" name="submit" class="btn btn-success">Envoyer</button>
    </form>


    <?php var_dump($_POST);?>
    <?php var_dump($_FILES);?>


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
</body>
</html>
