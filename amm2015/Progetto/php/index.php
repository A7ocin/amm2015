<?php

include_once 'controller/BaseController.php';
include_once 'controller/AdministratorController.php';
include_once 'controller/ArtistController.php';
include_once 'controller/UserController.php';

date_default_timezone_set("Europe/Rome");
FrontController::dispatch($_REQUEST);

/**
 * This is the start page
 * @author Nicola Garau
 */
class FrontController {

    /**
     * This is the request manager
     * @param array $request the request parameters
     */
    public static function dispatch(&$request) {
        // let's start the session
        session_start();
        if (isset($request["page"])) {

            switch ($request["page"]) {
                case "login":
                    // Since everyone can access the login page,
                    // it should be controlled by the BaseController
                    $controller = new BaseController();
                    $controller->handleInput($request);
                    break;
                    
                // administrator
                case 'administrator':
                    $controller = new AdministratorController();
                    if (isset($_SESSION[BaseController::role]) &&
                        $_SESSION[BaseController::role] != User::Administrator)  {
                        self::write403();
                    }
                    $controller->handleInput($request);
                    break;
                    
                // artist
                case 'artist':
                    $controller = new ArtistController();
                    if (isset($_SESSION[BaseController::role]) &&
                        $_SESSION[BaseController::role] != User::Artist)  {
                        self::write403();
                    }
                    $controller->handleInput($request);
                    break;
                    
                // user
                case 'user':
                    $controller = new UserController();
                    if (isset($_SESSION[BaseController::role]) &&
                        $_SESSION[BaseController::role] != User::Utente)  {
                        self::write403();
                    }
                    $controller->handleInput($request);
                    break;

                default:
                    self::write404();
                    break;
            }
        } else {
            self::write404();
        }
    }

    /**
     * Create an error page if the path doesn't exist
     */
    public static function write404() {
        // set http response code to 404 (file not found)
        header('HTTP/1.0 404 Not Found');
        $titolo = "File not found!";
        $messaggio = "The page you requested is not available";
        include_once('error.php');
        exit();
    }

    /**
     * Create an error page if the user is not allowed to access the page
     */
    public static function write403() {
        // set http response code to 403 (forbidden)
        header('HTTP/1.0 403 Forbidden');
        $titolo = "Access denied";
        $messaggio = "You don't have the rights to access this page";
        $login = true;
        include_once('error.php');
        exit();
    }

}

?>
