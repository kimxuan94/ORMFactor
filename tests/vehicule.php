<?php
header('Content-Type: charset=utf-8');

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;

include_once './app/Database.php';
include_once './app/Vehicule.php';

error_reporting(E_ALL);
ini_set('display_errors', true);

//Set connection to Database
$database = new Database();
$db = $database->getConnection();

$vehicule = new Vehicule($db);

$stmt = $vehicule->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();
?>
 <!DOCTYPE html>
 <html lang="fr">
   <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>OOP CRUD</title>

     <link href="./public/css/bootstrap.min.css" rel="stylesheet">
     <link href="./public/css/views.css" rel="stylesheet">

       <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

   </head>
   <body>
   <p><br/></p>
   <p>
<a class="btn btn-primary" href="ajouter_vehicule.php" role="button">Créer un nouveau véhicule</a>
<a class="btn btn-info" href="index.php" role="button">Aller au tableau de bord</a>
   </p>
   <caption><legend>Véhicules</legend></caption>
     <div class="container">
       <!-- <p>
 	<a class="btn btn-primary" href="ajouter_vehicule.php" role="button">Créer un nouveau véhicule</a>
  <a class="btn btn-info" href="index.php" role="button">Aller au tableau de bord</a>
       </p> -->
       <?php
     if($num>0){
     ?>
 	<table class="table table-bordered table-hover table-striped">
 	<thead>
 	 <tr>
           <th>Immatriculation</th>
           <th>N°contrat</th>
           <th>Loueur</th>
           <th>Valeur d'achat</th>
           <th>Date circulation</th>
           <th>Entrée parc</th>
           <th>Sortie parc</th>
           <th>Catégorie</th>
           <th>Marque</th>
           <th>Modèle</th>
           <th>Version</th>
           <th>N°chassis</th>
           <th>Commentaire</th>
           <th>Actions</th>
         </tr>
 	</thead>
 	  <tbody>
    <?php
      //Display collaborateur properties here
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
       ?>
      <tr>
        <?php echo "<td>{$immatriculation}</td>" ?>
        <?php echo "<td>{$no_contrat}</td>" ?>
        <?php echo "<td>{$loueur}</td>" ?>
        <?php echo "<td>{$valeur_achat}€</td>" ?>
        <?php echo "<td>{$date_circulation}</td>" ?>
        <?php echo "<td>{$date_entree_parc}</td>" ?>
        <?php echo "<td>{$date_sortie}</td>" ?>
        <?php echo "<td>{$categorie}</td>" ?>
        <?php echo "<td>{$marque}</td>" ?>
        <?php echo "<td>{$modele}</td>" ?>
        <?php echo "<td>{$version}</td>" ?>
        <?php echo "<td>{$no_chassis}</td>" ?>
        <?php echo "<td>{$commentaire}</td>" ?>
        <?php echo "<td width='100px'>
      	    <a class='btn btn-warning btn-sm' href='maj_vehicule.php?id={$id}' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
      	    <a class='btn btn-danger btn-sm' href='del_vehicule.php?id={$id}' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                </td>" ?>
              </tr>
              <?php
              }
              ?>
              	</tbody>
                    </table>
              <?php
              $page_dom = "vehicule.php";
              include_once './app/pagination.veh.php';
              }
              else{
              ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Attention!</strong> Vous n'avez aucun véhicule
              </div>
              <?php
              }
              ?>
                  </div>
                  <script src="./public/js/jquery.min.js"></script>
                  <script src="./public/js/bootstrap.min.js"></script>
                </body>
              </html>
