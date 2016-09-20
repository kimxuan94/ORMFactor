<?php
include_once './app/Database.php';
include_once './app/Collaborateur.php';

	// Set database connection
	$database = new Database();
	$db = $database->getConnection();

	// prepare collaborateur object
	$collaborateur = new Collaborateur($db);

	// set product collaborateur to be deleted
	$collaborateur->id = isset($_GET['id']) ? $_GET['id'] : die('Erreur avec l\'ID collaborateur');

	// delete the product
	if($collaborateur->deleteCollaborateur()){
		echo "<script>location.href='./pages/collaborateurs.php'</script>";
	}

	// if unable to delete the product
	else{
		echo "<script>alert('Erreur lors de la suppression')</script>";

	}
?>
