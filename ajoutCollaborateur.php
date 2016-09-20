<?php
// ini_set('error_reporting', E_STRICT);
include_once './app/Database.php';

// Set new connection
$database = new Database();
$db = $database->getConnection();

include_once './app/Collaborateur.php';
$collaborateur = new Collaborateur($db);

if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){

    $errors = [];

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


    //Gestion erreur formulaire
    $valid = true;

    if(empty($_POST['matriculerh']) || $_POST['matriculerh'] == ''){
      $errors['matriculerh'] = " Vous n'avez pas renseigné votre matricule";
      $valid = false;
    }
    if(empty($_POST['nom']) || $_POST['nom'] == ''){
      $errors['nom'] = " Vous n'avez pas renseigné votre nom";
      $valid = false;
    }
    if(empty($_POST['prenom']) || $_POST['prenom'] == ''){
      $errors['prenom'] = " Vous n'avez pas renseigné votre prénom";
      $valid = false;
    }
    if(empty($_POST['adresse']) || $_POST['adresse'] == ''){
      $errors['adresse'] = " Vous n'avez pas renseigné une adresse valide ";
      $valid = false;
    }
    if(empty($_POST['cp']) || $_POST['cp'] == ''){
      $errors['cp'] = " Vous n'avez pas renseigné de code postal valide ";
      $valid = false;
    }
    if(empty($_POST['ville']) || $_POST['ville'] == ''){
      $errors['ville'] = " Vous n'avez pas renseigné de ville valide ";
      $valid = false;
    }
    if(empty($_POST['tel']) || $_POST['tel'] == ''){
      $errors['tel'] = " Vous n'avez pas renseigné de numero valide ";
      $valid = false;
    }
    if(empty($_POST['avantage_nature']) || $_POST['avantage_nature'] == ''){
      $errors['avantage_nature'] = " Vous n'avez pas renseigné de montant valide ";
      $valid = false;
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

    if(empty($_POST['commentaire']) || $_POST['commentaire'] == ''){
      $errors['commentaire'] = " Votre commentaire contient des caractères interdits";
      $valid = false;
    }

    if($valid) {
    $collaborateur->createCollaborateur();
        ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <strong>Nouveau collaborateur enregistré!</strong>  <a href="../pages/collaborateurs.php">Voir les collaborateurs</a>.
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
