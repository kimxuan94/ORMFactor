<?php
session_start();
print_r($_SESSION);

require '../../app/conf.class.php';
ini_set('display_errors', 1);

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (null == $id) {
    // header("Location: index.php");
    echo 'Session is on';
}

if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){

	//Set error messages
	$idError = NULL;
	// $typecmpError = NULL;
	$pseudoError = NULL;
	$passError = NULL;
	$emailError = NULL;

	//Get inputs values
	$id = $_SESSION['idsession'];
	// $typecmp= $_SESSION['type'];
  $pseudo = $_POST['pseudo'];
  $pass = $_POST['pwd'];
  $email = $_POST['email'];

     //Formalize form inputs
    $valid = true;

    if(empty($id)){
    	$idError = 'Entrer ID du salarié';
    	$valid = false;}

    if (empty($typecmp)) {
        $typecmpError = 'Entrez pseudo du salarié';
        $valid = false;}

    if(empty($pseudo)){
        $pseudoError ='Entrez pseudo du salarié';
        $valid= false;}

    if (empty($pass)) {
        $passError = 'Renseignez mdp';
        $valid = false;}

    if (empty($email)) {
    	$emailError = 'Renseignez une adresse mail';
    	$valid = false;}

    //Data accepted so we'll connect to database
    if($valid) {
    $pdo = confDB::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE prive SET type_compte=? AND pseudo=? AND motdepasse=? AND e_mail=? WHERE id = '".$_SESSION["idsession"]."'";
		$req = $pdo->prepare($sql);
		$req->execute(array($id, $typecmp, $pseudo, $pass, $email));
		confDB::disconnect();
		// header("Location: index.php");
    }else {
        $pdo = confDB::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM prive WHERE id = '".$_SESSION["idsession"]."'";
        $req = $pdo->prepare($sql);
        $req->execute(array($id));
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $id = $data['id'];
        $typecmp = $data['type_compte'];
        $pseudo = $data['pseudo'];
        $pass = $data['motdepasse'];
        $email = $data['e_mail'];
        confDB::disconnect();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mise à jour des comptes</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../public/css/connexion.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    </head>
    <body>
<div class="container">

  <div class="news">
    <!-- <div class="jumbotron"> -->
      <h2><span class="glyphicon glyphicon-user"></span> Modifier mon profil :  </h2><br />


    <form class="jumbotron" method="POST" action="update.php?id=<?php echo $id;?>">
        <!-- <div class="control-group" <?php echo!empty($idError) ? 'error' : '';?>">
        <label class="control-label">ID</label>
        <div class="controls">
            <p><input name="id" type="text"  placeholder="ID" value="<?php echo!empty($id) ? $id : ''; ?>"></p>
                        <?php if (!empty($idError)): ?>
                            <span class="help-inline"><?php echo $idError; ?></span>
                        <?php endif; ?>
        </div>
        </div> -->

        <!-- <div class="control-group" <?php echo!empty($idError) ? 'error' : '';?>">
        <label class="control-label">ID</label>
        <div class="controls">
          <label><p><?php echo $_SESSION['idsession']; ?></p></label>
        </div>
        </div>

        <div class="control-group" <?php echo!empty($typecmpError) ? 'error' : '';?>">
        <label class="control-label">Type de compte</label>
        <div class="controls">
          <label><p><?php echo $_SESSION['type']; ?></p></label>

        </div>
        </div> -->


        <!-- <div class="control-group" <?php echo!empty($typecmpError) ? 'error' : '';?>">
        <label class="control-label">Type de compte</label>
        <div class="controls">
            <p><input name="type_compte" type="text"  placeholder="Type de compte" value="<?php echo!empty($typecmp) ? $typecmp : ''; ?>"></p>
                        <?php if (!empty($typecmpError)): ?>
                            <span class="help-inline"><?php echo $typecmpError; ?></span>
                        <?php endif; ?>
        </div>
        </div> -->

        <div class="control-group" <?php echo!empty($pseudoError) ? 'error' : '';?>">
        <label class="control-label">Pseudo</label>
        <div class="controls">
            <p><input name="pseudo" type="text"  placeholder="Pseudo" value="<?php echo!empty($pseudo) ? $pseudo : ''; ?>"></p>
                        <?php if (!empty($pseudoError)): ?>
                            <span class="help-inline"><?php echo $pseudoError; ?></span>
                        <?php endif; ?>
        </div>
        </div><br />

        <div class="control-group" <?php echo!empty($passError) ? 'error' : '';?>">
        <label class="control-label">Mot de passe</label>
        <div class="controls">
            <p><input name="pwd" type="password"  placeholder="Mot de passe" value="<?php echo!empty($pass) ? $pass : ''; ?>"></p>
                        <?php if (!empty($passError)): ?>
                            <span class="help-inline"><?php echo $passError; ?></span>
                        <?php endif; ?>
        </div>
        </div><br />

        <div class="control-group" <?php echo!empty($emailError) ? 'error' : '';?>">
        <label class="control-label">Adresse mail</label>
        <div class="controls">
            <p><input name="email" type="email"  placeholder="Adresse mail" value="<?php echo!empty($email) ? $email : ''; ?>"></p>
                        <?php if (!empty($emailError)): ?>
                            <span class="help-inline"><?php echo $emailError; ?></span>
                        <?php endif; ?>
        </div>
        </div>

<!-- <div class="form-actions">
                    <input type="submit" class="btn btn-success" name="submit" value="Mettre a jour">
                    <a class="btn" href="index.php">Precédent</a>
</div> -->

<div class="form-actions">
  <span class="but"><input type="submit" class="btn btn-success" name="submit" value="Mettre a jour">
  <a href="profil.php" class="btn btn-primary btn-md">Retour à mon profil</a></span>
</div>

            </form>
</div>
<!-- </div> -->
    </body>
</html>
