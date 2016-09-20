<?php
include_once './app/Database.php';

// Set new connection
$database = new Database();
$db = $database->getConnection();

include_once './app/Loueur.php';
$loueur = new Loueur($db);

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
<?php
$sth = $db->prepare("SELECT id, rsociale FROM societe_location");
$sth->execute();

$option = '';
/*$res = $sth->fetchAll(PDO::FETCH_ASSOC);
print_r($res);*/

while($row = $sth->fetch(PDO::FETCH_ASSOC))
{
	$option .= '<option value = "'.$row['id'].'">'.$row['rsociale'].'</option>';
}

?>

<select> 
<?php echo $option; ?>
</select>

<?php
if($loueur->setLoueur()){
	echo 'OK';
} else {
	return false;
}
?>

  <script src="./public/js/jquery.min.js"></script>
  <script src="./public/js/bootstrap.min.js"></script>

  <!--Webservice feature-->
  <script src="./public/js/vehicule_service.js"></script>
  <script src="./public/js/renters_service.js"></script>
  <script src="./public/js/selectbox.js"></script>
</body>

</html>