  <!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>AutoFloat</title>

     <!-- Latest compiled and minified CSS -->
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
 <!-- <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" /> -->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/views.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
      <![endif]-->
      <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">AutoFloat</a>
      </div>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Connexion</a></li>
      </ul> -->
    </div>
  </nav>
    </head>

    <body>
  <div class="row affix-row">
      <div class="col-sm-3 col-md-2 affix-sidebar">
  		<div class="sidebar-nav">
    <div class="navbar navbar-default" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <span class="visible-xs navbar-brand">Menu</span>
      </div>
      <div class="navbar-collapse collapse sidebar-navbar-collapse">
        <ul class="nav navbar-nav" id="sidenav01">
          <li class="active">
            <a href="#" data-toggle="collapse" data-target="#toggleDemo0" data-parent="#sidenav01" class="collapsed">
            <h4>
            Pilotage
            <br>
  <!--           <small>IOSDSV <span class="caret"></span></small>
   -->          </h4>
            </a>
            <div class="collapse" id="toggleDemo0" style="height: 0px;">
              <ul class="nav nav-list">
                <li><a href="index.php" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <span class="glyphicon glyphicon-tasks"></span> Tableau de bord <span class="caret pull-right"></span>
            </a></li>
            <li><a href="alertes.php" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <span class="glyphicon glyphicon-warning-sign"></span> Alertes <span class="caret pull-right"></span>
            </a></li>
              </ul>
            </div>
          </li>

          <!--Bloc2-->
          <li class="active">
            <a href="#" data-toggle="collapse" data-target="#toggleDemo1" data-parent="#sidenav01" class="collapsed">
            <h4>
            Gestion
            <br>
  <!--           <small>IOSDSV <span class="caret"></span></small>
   -->          </h4>
            </a>
            <div class="collapse" id="toggleDemo1" style="height: 0px;">
              <ul class="nav nav-list">
                <li><a href="collaborateurs.php" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <span class="glyphicon glyphicon-user"></span> Collaborateurs<span class="caret pull-right"></span>
            </a></li>
            <li><a href="vehicules.php" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <span class=" glyphicon glyphicon-road"></span> Véhicules<span class="caret pull-right"></span>
            </a></li>
            <li><a href="frais.php" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <span class=" glyphicon glyphicon-euro"></span> Frais<span class="caret pull-right"></span>
            </a></li>
            <li><a href="contrats.php" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <span class="glyphicon glyphicon-list-alt"></span> Contrats<span class="caret pull-right"></span>
            </a></li>
              </ul>
            </div>
          </li>

          <li class="active">
            <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
            <h4>
            Informations
            <br>
  <!--           <small>IOSDSV <span class="caret"></span></small>
   -->          </h4>
            </a>
          </li>

          <li class="active">
            <a href="#" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav01" class="collapsed">
            <h4>
            Paramètres
            <br>
  <!--           <small>IOSDSV <span class="caret"></span></small>
   -->          </h4>
            </a>
            <div class="collapse" id="toggleDemo3" style="height: 0px;">
              <ul class="nav nav-list">
                <li><a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <span class="glyphicon glyphicon-pencil"></span> Gestion des listes<span class="caret pull-right"></span>
            </a></li>
            <li><a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <span class=" glyphicon glyphicon-search"></span> Reporting<span class="caret pull-right"></span>
            </a></li>
            <li><a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <span class=" glyphicon glyphicon-lock"></span> Gestion des comptes<span class="caret pull-right"></span>
            </a></li>
              </ul>
            </div>
          </li>
        </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  	</div>

    <div class="col-sm-9 col-md-10 affix-content">
      <form action="#" method="GET">
          <span id="search">
            <input id="search" type="text" placeholder="Taper un mot clé">
            <input id="submit" type="submit" value="Rechercher" class="btn btn-info">
         </span>
      </form>
  		<div class="container">
                        <h1>Bienvenue dans votre tableau de bord</h1><br>
        	<!-- <div class="col-md-9">
          		<div style="height: 100%">
                <h1>DASHBOARD PLACE</h1>
     	  		  </div>
        	</div> -->

        <div class="row">
        <div class="col-xs-6 col-sm-4">
          <h3><i class="material-icons">&#xE531;</i>
          Nombre de véhicules</h3><br>
            <ul class="list-group">
              <li class="list-group-item">
                <span class="badge">0</span>
                VP
              </li>
              <li class="list-group-item">
                <span class="badge">0</span>
                VU
              </li>
              <li class="list-group-item">
                <span class="badge">0</span>
                VI
              </li>
            </ul>
        </div>
        <div class="col-xs-6 col-sm-4">
          <h3><i class="material-icons">&#xE8B2;</i>
          Nombre de km</h3><br>
          <ul class="list-group">
            <li class="list-group-item">
              <span class="badge">0</span>
              Dernier kilométrage moyen du parc
            </li>
            <li class="list-group-item">
              <span class="badge">0</span>
              <br>
            </li>
            <li class="list-group-item">
              <span class="badge">0</span>
              <br>
            </li>
          </ul>
        </div>
        <div class="col-xs-6 col-sm-4">
          <h3><i class="material-icons">&#xE7F7;</i>
          Alertes</h3><br>
          <ul class="list-group">
            <li class="list-group-item">
              <span class="badge">0</span>
              Kilomètrage
            </li>
            <li class="list-group-item">
              <span class="badge">0</span>
              Contrat
            </li>
            <li class="list-group-item">
              <span class="badge">0</span>
              <br>
            </li>
          </ul>
        </div>
      </div>

      	</div>
  	<!-- 			<div class="page-header">
  	         <h3><span class="glyphicon glyphicon-th-list"></span> Accueil</h3>
  				</div> -->

  	</div>
    <footer>
      Autofloat @Biocodex - Projet réalisé par Ophélie Toumine
    </footer>
  	<!--</div>
  </div>-->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <!-- <script type="text/javascript" src="js/jquery-3.0.0.js"></script> -->
  <!--Angular implements-->
        <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> -->
  </body>
  </html>
