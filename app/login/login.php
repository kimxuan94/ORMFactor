<?php
session_start();
include_once '../../app/conf.class.php';


// $_SESSION['login'] = $_POST['pseudo'];
// $_SESSION['pwd'] = $_POST['pwd'];
// $_SESSION['idsession'] = $row['id'];
// ini_set('display_errors', 1);

if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){

  //Set error messages
	$pseudoError = '';
	$passError = '';
	$conError = "La connexion n'a pas aboutie";

  $pseudo = htmlentities(trim($_POST['pseudo']));
  $pass = htmlentities(trim(md5($_POST['pwd'])));

	$valid = true;

  if(empty($pseudo)){
    $pseudoError = 'Entrer le pseudo du salarié';
    $valid = false;
  }

  if (empty($pass)) {
      $passError = 'Entrez le mot de passe du salarié';
      $valid = false;
  }
}//fin

  if(isset($valid)){
    if($_POST['pseudo'] AND md5($_POST['pwd'] == $valid)){
      // echo 'good job';
      $pdo = confDB::connect();
      // $sql = $pdo->query("SELECT * FROM prive WHERE pseudo='$user'");
      $sql = "SELECT * FROM prive WHERE pseudo='$pseudo' AND motdepasse='$pass'";
      foreach ($pdo->query($sql) as $row) {
      {
        if($_POST['pseudo'] == $row['pseudo']||md5($_POST['pwd']) == $row['motdepasse'] ){
          // require('profil.php');

					$_SESSION['login'] = $_POST['pseudo'];
					$_SESSION['pwd'] = $_POST['pwd'];
					$_SESSION['idsession'] = $row['id'];
      }
    }
    confDB::disconnect();
		header('Location: profil.php');
  }
}//final
// else
// 	echo $conError;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Connexion</title>

          <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
          <link rel="stylesheet" type="text/css" href="../../public/css/connexion.css">
        	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css" rel="stylesheet"> -->
    </head>
  <body>
		<div class="container">
		<?php if (isset($valid)): ?>
		<div class="alert alert-danger" role="alert">
    <!-- <a class="close" data-dismiss="alert"><i class="icon-remove"></i></a> -->
		<?php if (!empty($conError)): ?>
			<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
				<span class="help-inline"><?php echo $conError;?></span>
		<?php endif; ?>
	<?php endif; ?>

	</div>

		</div>
			<div class="page-header">
		<h1>Bienvenue dans l'espace prive <small>Déjà chez nous? Connectez-vous</small></h1>
			</div>
		<form class="" action="index.php" method="POST">
			<div class="row">
				 <div class="form-group col-lg-8">
					 <legend><h4><span class="glyphicon glyphicon-home"></span> Accéder à mon compte</h4></legend>
					<!-- <label for="Pseudo">Pseudo</label>
					<input type="text" class="form-control input" name="pseudo" placeholder="Entrez votre pseudo">
					<label for="mdp">Mot de passe</label>
					<input type="password" class="form-control input" name="pwd" placeholder="Entrez votre mot de passe"> -->
          <div class="control-group <?php echo !empty($pseudoError)?'error':'';?>">
              <label class="control-label">Pseudo</label>
          	<div class="controls">
                  <input name="pseudo" type="text" class="form-control" placeholder="Pseudo ici" value="<?php echo !empty($pseudo)?$pseudo:'';?>">
                  <?php if (!empty($pseudoError)): ?>
                      <span class="help-inline"><?php echo $pseudoError;?></span>
                  <?php endif; ?>
          	</div>
          </div><br />

          <div class="control-group <?php echo !empty($passError)?'error':'';?>">
              <label class="control-label">Mot de passe</label>
          	<div class="controls">
                  <input name="pwd" type="password" class="form-control" placeholder="Mot de passe ici" value="<?php echo !empty($pass)?$pass:'';?>">
                  <?php if (!empty($passError)): ?>
                      <span class="help-inline"><?php echo $passError;?></span>
                  <?php endif; ?>
          	</div>
          </div><br />

        </div>
			</div>
			<a href="envoi_mail.php">Mot de passe oublié?</a>
			<button type="submit" class="btn btn-primary btn-md">Je me connecte</button>

    </form>
	</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<script type="text/javascript">
	$(".alert-message").alert();
window.setTimeout(function() { $(".alert-message").alert('close'); }, 2000);
	</script>
  </body>
</html>
