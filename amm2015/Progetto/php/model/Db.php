<?php
include_once basename(__DIR__) . '/../Settings.php';

/**
 * Description of Db
 *
 * @author Nicola Garau
 */
class Db {
    
    private function __construct() {
        
    }
    
    private static $singleton;
    /**
     *  Return a singleton to connect to the database
     * @return \Db
     */
    public static function getInstance(){
        if(!isset(self::$singleton)){
            self::$singleton = new Db();
        }
        
        return self::$singleton;
    }
    
    /**
     * Return a connection to the Db
     * @return \mysqli a connection to the Db or null in case of error
     */
    public function connectDb(){
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user,
        Settings::$db_password, Settings::$db_name);
        if($mysqli->errno != 0){
            return null;
        }else{
            return $mysqli;
        }
    }
}

?>
