<?php

require '../app/Database.php';


if(isset($_GET['p'])){
    $p = $_GET['p'];
} else{
    $p = 'dashboard';
}

//Initialisation des objets
// $db = new App\Database('biocodex_orm');

if($p === 'dashboard'){
    require '../pages/dashboard.php';
}
ob_start();
// if($p === 'home'){
//     require '../pages/home.php';
// }
//  elseif($p === 'single'){
//     require '../pages/single.php';
// }
if($p === 'vehicules'){
    require '../pages/vehicules.php';
}
elseif($p === 'collaborateurs'){
    require '../pages/collaborateurs.php';
}
elseif($p === 'frais'){
    require '../pages/frais.php';
}
elseif($p === 'contrats'){
    require '../pages/contrats.php';
}

$content = ob_get_clean();
require '../pages/templates/default.php';

?>
