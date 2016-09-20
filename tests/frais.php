<?php
header('Content-Type: charset=utf-8');

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;

include_once 'includes/config.php';
include_once 'includes/frais.inc.php';

error_reporting(E_ALL);
ini_set('display_errors', true);

//Set connection to Database
$database = new Connection();
$db = $database->getConnection();

$frais = new Frais($db);

$stmt = $frais->readAll($page, $from_record_num, $records_per_page);
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
<a class="btn btn-primary" href="ajouter_frais.php" role="button">Créer un nouveau frais</a>
<a class="btn btn-info" href="index.php" role="button">Aller au tableau de bord</a>
   </p>
   <caption><legend>Frais</legend></caption>
     <div class="container">
       <!-- <p>
 	<a class="btn btn-primary" href="ajouter_frais.php" role="button">Créer un nouveau frais</a>
  <a class="btn btn-info" href="index.php" role="button">Aller au tableau de bord</a>
       </p> -->
       <?php
     if($num>0){
     ?>
 	<table class="table table-bordered table-hover table-striped">
 	<thead>
 	 <tr>
           <th>Poste de frais n°</th>
           <th>Réparation</th>
           <th>Gardiennage</th>
           <th>Remplacement</th>
           <th>Remise_neuf</th>
           <th>Supplément pneu</th>
           <th>Date de facturation</th>
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
        <?php echo "<td>{$poste_frais}</td>" ?>
        <?php echo "<td>{$reparation}€</td>" ?>
        <?php echo "<td>{$gardiennage}€</td>" ?>
        <?php echo "<td>{$remplacement}€</td>" ?>
        <?php echo "<td>{$remise_neuf}€</td>" ?>
        <?php echo "<td>{$supp_pneu}€</td>" ?>
        <?php echo "<td>{$date_facturation}</td>" ?>
        <!-- date("jS F, Y", strtotime("11.12.10") -->
        <?php echo "<td>{$commentaire}</td>" ?>
        <?php echo "<td width='100px'>
      	    <a class='btn btn-warning btn-sm' href='maj_frais.php?id={$poste_frais}' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
      	    <a class='btn btn-danger btn-sm' href='del_frais.php?id={$poste_frais}' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                </td>" ?>
              </tr>
              <?php
              }
              ?>
              	</tbody>
                    </table>
              <?php
              $page_dom = "frais.php";
              include_once 'includes/pagination.frais.php';
              }
              else{
              ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Attention!</strong> Vous n'avez aucun frais
              </div>
              <?php
              }
              ?>
                  </div>
                  <script src="js/jquery.min.js"></script>
                  <script src="js/bootstrap.min.js"></script>
                </body>
              </html>
