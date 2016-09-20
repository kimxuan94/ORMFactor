<?php
header('Content-Type: charset=utf-8');

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;

include_once 'includes/config.php';
include_once 'includes/contrat.inc.php';

error_reporting(E_ALL);
ini_set('display_errors', true);

//Set connection to Database
$database = new Connection();
$db = $database->getConnection();

$contrat = new Contrat($db);

$stmt = $contrat->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();
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
<a class="btn btn-primary" href="ajouter_contrat.php" role="button">Créer un nouveau contrat</a>
<a class="btn btn-info" href="index.php" role="button">Aller au tableau de bord</a>
   </p>
   <caption><legend>Contrats</legend></caption>
     <div class="container">
       <!-- <p>
 	<a class="btn btn-primary" href="ajouter_frais.php" role="button">Créer un nouveau contrat</a>
  <a class="btn btn-info" href="index.php" role="button">Aller au tableau de bord</a>
       </p> -->
       <?php
     if($num>0){
     ?>
 	<table class="table table-bordered table-hover table-striped">
 	<!-- <caption><legend>Contrat</legend></caption> -->
 	<thead>
 	 <tr>
     <th>Contrat n°</th>
     <th>ID VEH</th>
     <th>ID RH</th>
     <th>Collaborateurs</th>
     <th>Véhicules</th>
     <th>Début contrat</th>
     <th>Fin contrat</th>
     <th>Valeur franchise</th>
     <th>Nombre d'accidents</th>
     <th>Franchise n°1</th>
     <th>Franchise n°2</th>
     <th>Franchise n°3</th>
     <th>Franchise n°4</th>
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
        <?php echo "<td>{$no_contrat}</td>" ?>
        <?php echo "<td>{$immatricule_id}</td>" ?>
        <?php echo "<td>{$matricule_id}</td>" ?>
        <?php echo "<td>{$l_collaborateurs}</td>" ?>
        <?php echo "<td>{$l_vehicules}</td>" ?>
        <?php echo "<td>{$debut_contrat}</td>" ?>
        <?php echo "<td>{$fin_contrat}</td>" ?>
        <?php echo "<td>{$val_franchise}€</td>" ?>
        <?php echo "<td>{$nb_accidents}</td>" ?>
        <?php echo "<td>{$prem_franchise_accident}€</td>" ?>
        <?php echo "<td>{$deux_franchise_accident}€</td>" ?>
        <?php echo "<td>{$troi_franchise_accident}€</td>" ?>
        <?php echo "<td>{$quat_franchise_accident}€</td>" ?>
        <?php echo "<td>{$commentaires}</td>" ?>
        <?php echo "<td width='100px'>
      	    <a class='btn btn-warning btn-sm' href='maj_contrat.php?id={$no_contrat}' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
      	    <a class='btn btn-danger btn-sm' href='del_contrat.php?id={$no_contrat}' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                </td>" ?>
              </tr>
              <?php
              }
              ?>
              	</tbody>
                    </table>
              <?php
              $page_dom = "contrats.php";
              include_once 'includes/pagination.contrat.php';
              }
              else{
              ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Attention!</strong> Vous n'avez aucun contrat
              </div>
              <?php
              }
              ?>
                  </div>
                  <script src="js/jquery.min.js"></script>
                  <script src="js/bootstrap.min.js"></script>
                </body>
              </html>
