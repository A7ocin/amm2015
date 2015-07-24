<?php

/**
 * Configuration class
 *
 * @author Nicola Garau
 */
class Settings {

    // database access variables
    public static $db_host = 'localhost';
    public static $db_user = 'garauNicola';
    public static $db_password = 'scimpanze6785';
    public static $db_name='amm15_garauNicola';
    
    private static $appPath;

    /**
     * It switches between localhost and the public server
     */
    public static function getApplicationPath() {
        if (!isset(self::$appPath)) {
            // return the current server
            switch ($_SERVER['HTTP_HOST']) {
                case 'localhost':
                    // local configuration
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2015/Progetto/';
                    break;
                case 'spano.sc.unica.it':
                    // public configuration
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2015/garauNicola/amm2015/Progetto/';
                    break;

                default:
                    self::$appPath = '';
                    break;
            }
        }
        
        return self::$appPath;
    }

}

?>
