<?php
  session_start();
  // $_SESSION['login'] = $_POST['pseudo'];
  // $_SESSION['pwd'] = $_POST['pwd'];
  // $_SESSION['idsession'] = $row['id'];
  print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Profil</title>

          <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" type="text/css" href="../../public/css/connexion.css">
          <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css" rel="stylesheet">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
      <legend><h4>Informations compte utilisateur : </h4></legend>
    </body>
<?php
include_once '../../app/conf.class.php';
$pdo = confDB::connect();

$req = $pdo->query("SELECT * FROM prive WHERE id = '".$_SESSION["idsession"]."'");

while ($donnees = $req->fetch())
{
?>
<div class="news">
  <div class="jumbotron">
    <h2><span class="glyphicon glyphicon-user"></span> Mon profil :  </h2><br />

<p><label> Type de compte :</label> <?php echo htmlspecialchars($donnees['type_compte']); ?></p>
<p><label> Pseudo :</label> <?php echo htmlspecialchars($donnees['pseudo']); ?></p>
<p><label> Mot de passe :</label> <?php echo 'celui que vous avez choisi lors de votre inscription'; ?></p>
<p><label> E-mail :</label> <?php echo htmlspecialchars($donnees['e_mail']); ?></p>

<div class="form-actions">
  <!-- <form action="update.php" method="GET"> -->
<span class="but"><a href="update.php?id=<?php echo '".$_SESSION["idsession"]."';?>" class="btn btn-success btn-md">Modifier mes infos</a>
<a href="index.php" class="btn btn-primary btn-md">Je me déconnecte</a></span>
<!-- </form> -->
</div>

</div>

<?php
} // Fin de la boucle des billets?>
<?php
$req->closeCursor();
// session_destroy();
?>
</html>
