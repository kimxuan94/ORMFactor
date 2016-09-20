<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;

include_once '../app/Database.php';
include_once '../app/Contrat.php';

error_reporting(E_ALL);
ini_set('display_errors', true);

//Set connection to Database
$database = new Database();
$db = $database->getConnection();

$contrat = new Contrat($db);

$stmt = $contrat->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();
?>

      <link href="../public/css/bootstrap.min.css" rel="stylesheet">
     <link href="../public/css/views.css" rel="stylesheet">

       <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

   </head>
   <body>
   <p><br/></p>
   <p>
<a class="btn btn-primary" href="../ajouter_contrat.php" role="button">Créer un nouveau contrat</a>
<a class="btn btn-info" href="../pages/dashboard.php" role="button">Aller au tableau de bord</a>
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
     <th>#</th>
     <th>Réf contrat</th>
     <th>Collaborateur</th>
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
        <?= "<td>{$id}</td>" ?>
        <?= "<td>{$ref_contrat}</td>" ?>
        <?= "<td>{$collaborateur}</td>" ?>
              <?php echo "<td width='150px'>
            <a class='btn btn-default btn-sm' href='../read_contrat.php?id={$id}' role='button'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a>
      	    <a class='btn btn-warning btn-sm' href='../maj_contrat.php?id={$id}' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
      	    <a class='btn btn-danger btn-sm' href='../del_contrat.php?id={$id}' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                </td>" ?>
              </tr>
              <?php
              }
              ?>
              	</tbody>
                    </table>
              <?php
              $page_dom = "contrats.php";
              include_once '../app/pagination.contrat.php';
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
