<?php

class Fichier {

  private $conn;
  private $table_name = "Fichiers";

  public $id;
  public $nom;
  public $type;
  public $date;
  public $data;

  public function __construct($db) {
    $this->conn = $db;
  }

  function readFichier() {

    $query = "SELECT *,
    FROM" . $this->table_name . " ORDER BY id_fichier"

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;

  }

  //Fonction de lecture fichiers
    $extension='';
    $files_array = array();

    $dir = 'uploads';

    if ($handle = opendir($dir)) {
       //echo 'Liste des fichiers :<br/>';
     echo '<legend>Voici les fichiers trouvés</legend>'. '</br>';

       while (false !== ($file = readdir($handle))) {
         if($file != '.' && $file != '..') {
             echo '<table><hr><a href="'.$dir.'/'.$file.'">'.$file.'</a></table><button type="submit" value="télécharger">Télécharger</button><br/>';
          }
        }
    }
    closedir($handle);

}
?>
