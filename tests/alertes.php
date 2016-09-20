<?php
header('Content-Type: charset=utf-8');

include_once 'includes/config.php';
include_once 'includes/collaborateur.inc.php';

error_reporting(E_ALL);
ini_set('display_errors', true);

$database = new Connection();
$db = $database->getConnection();

$collaborateur = new Collaborateur($db);

// Fonction de calcul date diff à exécuter :)
?>

 <!DOCTYPE html>
 <html lang="fr">
   <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>OOP CRUD</title>

     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/views.css" rel="stylesheet">

       <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

   </head>
   <body>
   <p><br/></p>
   <p>
<a class="btn btn-primary" href="collaborateurs.php" role="button">Retour aux collaborateurs</a>
<a class="btn btn-info" href="index.php" role="button">Aller au tableau de bord</a>
   </p>
   <caption><legend>Vos alertes</legend></caption>
     <div class="container">
   <!-- <caption><legend>Contrat</legend></caption> -->
   <div class="alert alert-info" role="alert">
     <legend>1er test alerte</legend>
       <?php
       $s = $collaborateur->sayHello();
       ?>
   </div>
   <div class="alert alert-info" role="alert">
     <legend>2ème test alerte</legend>
     <?php
     $d = $collaborateur->setAlerte();
     var_dump($d);
      ?>
   </div>
   <div class="alert alert-info" role="alert">
     <legend>3ème test alerte</legend>
     <?php
     $d = $collaborateur->setAlerte();
     var_dump($d);

      ?>
   </div>
    </div>

  </body>
</html>
