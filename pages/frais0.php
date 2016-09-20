<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;


include_once '../app/Database.php';
include_once '../app/Frais.php';

error_reporting(E_ALL);
ini_set('display_errors', true);

//Set connection to Database
$database = new Database();
$db = $database->getConnection();

$frais = new Frais($db);

$stmt = $frais->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();
?>

     <link href="../public/css/bootstrap.min.css" rel="stylesheet">
     <link href="../public/css/views.css" rel="stylesheet">

   <p><br/></p>
   <p>
<a class="btn btn-primary" href="../ajouter_frais.php" role="button">Créer un nouveau frais</a>
<a class="btn btn-info" href="../pages/dashboard.php" role="button">Aller au tableau de bord</a>
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
           <th>Montant réparation</th>
           <th>Montant gardiennage</th>
           <th>Montant remplacement</th>
           <th>Montant remise à neuf</th>
           <!-- <th>Date de facturation</th> -->
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
        <?= "<td>{$numero_poste}</td>" ?>
        <?= "<td>{$montant_reparation} €</td>" ?>
        <?= "<td>{$montant_gardiennage} €</td>" ?>
        <?= "<td>{$montant_remplacement} €</td>" ?>
        <?= "<td>{$montant_remise_neuf} €</td>" ?>
        <!-- date("jS F, Y", strtotime("11.12.10") -->
        <?= "<td>{$commentaire}</td>" ?>
        <?= "<td width='150px'>
            <a class='btn btn-default btn-sm' href='../read_frais.php?id={$id}' role='button'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a>
      	    <a class='btn btn-warning btn-sm' href='../maj_frais.php?id={$id}' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
      	    <a class='btn btn-danger btn-sm' href='../del_frais.php?id={$id}' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                </td>" ?>
              </tr>
              <?php
              }
              ?>
              	</tbody>
                    </table>
              <?php
              $page_dom = "frais.php";
              include_once '../app/pagination.frais.php';
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
