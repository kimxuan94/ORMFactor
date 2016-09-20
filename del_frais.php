<?php
include_once './app/Database.php';
include_once './app/Frais.php';

	// Set database connection
	$database = new Database();
	$db = $database->getConnection();

	// prepare collaborateur object
	$frais = new Frais($db);

	// set product collaborateur to be deleted
	$frais->id = isset($_GET['id']) ? $_GET['id'] : die('Erreur avec l\'ID collaborateur');

	// delete the product
	if($frais->deleteFrais()){
		echo "<script>location.href='./pages/frais.php'</script>";
	}

	// if unable to delete the product
	else{
		echo "<script>alert('Erreur lors de la suppression')</script>";

	}
?>
