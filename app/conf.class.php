<?php
ini_set('display_errors', 1);

class confDB
{
    private static $dbName = 'biocodex_orm' ;
    private static $dbHost = 'localhost' ;
    private static $dbUser = 'usedev';
    private static $dbPassword = '';

    private static $cont  = null;

    public function __construct() {
        die('Problem with constructor');
    }

    public static function connect()
    {

       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUser, self::$dbPassword);
          // echo 'Connexion done with success'.'<br />';
          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e)
        {
        error_log($e->getMessage());
        die("A database error was encountered -> " . $e->getMessage());
        }
       }
       return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
