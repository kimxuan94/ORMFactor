<?php

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;

include_once '../app/Database.php';
include_once '../app/Collaborateur.php';

// error_reporting(E_ALL);
// ini_set('display_errors', true);


//Set connection to Database
$database = new Database();
$db = $database->getConnection();

$collaborateur = new Collaborateur($db);

$stmt = $collaborateur->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();
?>

<link href="../public/css/bootstrap.min.css" rel="stylesheet">
<link href="../public/css/views.css" rel="stylesheet">
   <p><br/></p>
   <p>
<a class="btn btn-primary" href="../ajouter_collaborateur.php" role="button">Créer un nouveau collaborateur</a>
<a class="btn btn-info" href="../pages/dashboard.php" role="button">Aller au tableau de bord</a>
   </p>
   <caption><legend>Collaborateurs</legend></caption>
     <div class="container">

       <?php
     if($num>0){
     ?>
 	<table class="table table-bordered table-hover table-striped">
 	<thead>
 	 <tr>
           <th>Matricule RH</th>
           <th>Nom</th>
           <th>Prenom</th>
           <th>Adresse</th>
           <th>Code postal</th>
           <th>Ville</th>
           <th>Telephone</th>
           <th>Categorie profesionnelle</th>
           <th>Avantages naturels</th>
           <th>Date entrée</th>
           <th>Date sortie</th>
           <th>Commentaire</th>
           <th>Actions</th>
         </tr>
 	</thead>
 	  <tbody>
    <?php
      //Display collaborateur properties here
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      // file_put_contents('.jpeg',$justificatif);
//       $DT = new DateTimeFrench($date_entree->date_entree);
//       echo $DT->format('l j F Y'), '<br />';
       ?>
      <tr>
        <?= "<td>{$matriculerh}</td>" ?>
        <?= "<td>{$nom}</td>" ?>
        <?= "<td>{$prenom}</td>" ?>
        <?= "<td>{$adresse}</td>" ?>
        <?= "<td>{$cp}</td>" ?>
        <?= "<td>{$ville}</td>" ?>
        <?= "<td>{$tel}</td>" ?>
        <?= "<td>{$categorie_pro}</td>" ?>
        <?= "<td>{$avantages} €</td>" ?>
        <?= "<td>{$date_entree}</td>" ?>
        <?= "<td>{$date_sortie}</td>" ?>
        <?= "<td>{$commentaire}</td>" ?>
        <?= "<td width='150px'>
            <a class='btn btn-default btn-sm' href='../read_collaborateur.php?id={$id}' role='button'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a>
      	    <a class='btn btn-warning btn-sm' href='../maj_collaborateur.php?id={$id}' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
      	    <a class='btn btn-danger btn-sm' href='../del_collaborateur.php?id={$id}' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                </td>" ?>
              </tr>
              <?php
              }
              ?>
              	</tbody>
                    </table>
              <?php
              $page_dom = "collaborateurs.php";
              include_once '../app/pagination.inc.php';
              }
              else{
              ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Attention!</strong> Vous n'avez aucun collaborateur
              </div>
              <?php
              }
              ?>
</div>
