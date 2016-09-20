<?php
include_once './app/Database.php';
include_once './app/Vehicule.php';

	// Set database connection
	$database = new Database();
	$db = $database->getConnection();

	// prepare collaborateur object
	$vehicule = new Vehicule($db);

	// set product collaborateur to be deleted
	$vehicule->id = isset($_GET['id']) ? $_GET['id'] : die('Erreur avec l\'ID collaborateur');

	// delete the product
	if($vehicule->deleteVehicule()){
		echo "<script>location.href='./pages/vehicules.php'</script>";
	}

	// if unable to delete the product
	else{
		echo "<script>alert('Erreur lors de la suppression')</script>";

	}
?>
