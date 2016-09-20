<?php

class Loueur {

  //Database connection property object and table name property
  public $conn;
  public $table_name = "loueurs";

  //Create object properties of collaborateurs
  public $id;
  public $rsociale;
  public $option;

  //Create vehicule constructor
  public function __construct($db) {
    $this->conn = $db;
  }

   public function setLoueur(){
        $sth = $this->conn->prepare("SELECT id, rsociale FROM loueurs");
        $sth->execute();

        $option = '';
        /*$res = $sth->fetchAll(PDO::FETCH_ASSOC);
        print_r($res);*/
        echo '<label>Société de location</label><select class="form-control" id="loueur" name="loueur">';

        while($row = $sth->fetch(PDO::FETCH_ASSOC))
        {
          $option .= '<option value = "'.$row['id'].'">'.$row['rsociale'].'</option>';
        }
        echo '</select>';
  }
      //getList()
}


   /*
<!--     public function setJson()
    {

	  $json = file_get_contents('./public/js/renter.json');
	  $data = json_decode($json, TRUE);

	 /* foreach($data['renters']['renter'] as $key => $r) {
	  	echo $r['id']. " " . $r['rsociale'] . "<br />";
	  }*/

	  //Insert into db test
/*	  $query = "INSERT INTO " . $this->table_name . " values(:id, :rsociale)";
/

       foreach($data['renters']['renter'] as $key => $r) {
	  	echo $r['id']. " " . $r['rsociale'] . "<br />";
	  }

	  $query = "INSERT INTO " . $this->table_name . " values(?,?)";

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->id);
      $stmt->bindParam(2, $this->rsociale);

      if($stmt->execute()) {
        return true;
      } else {
        return false;
      }
   }


   //Populate selectbox from sql

} -->*/
