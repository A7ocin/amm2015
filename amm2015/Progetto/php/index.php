<?php


include_once 'controller/BaseController.php';
include_once 'controller/StudenteController.php';
include_once 'controller/DocenteController.php';
include_once 'controller/AdministratorController.php';
include_once 'controller/ArtistController.php';
include_once 'controller/UserController.php';

date_default_timezone_set("Europe/Rome");
// punto unico di accesso all'applicazione
FrontController::dispatch($_REQUEST);

/**
 * Classe che controlla il punto unico di accesso all'applicazione
 * @author Davide Spano
 */
class FrontController {

    /**
     * Gestore delle richieste al punto unico di accesso all'applicazione
     * @param array $request i parametri della richiesta
     */
    public static function dispatch(&$request) {
        // inizializziamo la sessione 
        session_start();
        if (isset($request["page"])) {

            switch ($request["page"]) {
                case "login":
                    // la pagina di login e' accessibile a tutti,
                    // la facciamo gestire al BaseController
                    $controller = new BaseController();
                    $controller->handleInput($request);
                    break;

                // studente
                case 'studente':
                    // la pagina degli studenti e' accessibile solo agli studenti
                    // agli studenti ed agli amminstratori
                    // il controllo viene fatto dal controller apposito
                    $controller = new StudenteController();
                    if (isset($_SESSION[BaseController::role]) &&
                        $_SESSION[BaseController::role] != User::Studente) {
                        self::write403();
                    }
                    $controller->handleInput($request);
                    break;

                // docente
                case 'docente':
                    // la pagina dei docenti e' accessibile solo
                    // ai docenti ed agli amminstratori
                    // il controllo viene fatto dal controller apposito
                    $controller = new DocenteController();
                    if (isset($_SESSION[BaseController::role]) &&
                        $_SESSION[BaseController::role] != User::Docente)  {
                        self::write403();
                    }
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
     * Crea una pagina di errore quando il path specificato non esiste
     */
    public static function write404() {
        // impostiamo il codice della risposta http a 404 (file not found)
        header('HTTP/1.0 404 Not Found');
        $titolo = "File not found!";
        $messaggio = "The page you requested is not available";
        include_once('error.php');
        exit();
    }

    /**
     * Crea una pagina di errore quando l'utente non ha i privilegi 
     * per accedere alla pagina
     */
    public static function write403() {
        // impostiamo il codice della risposta http a 404 (file not found)
        header('HTTP/1.0 403 Forbidden');
        $titolo = "Access denied";
        $messaggio = "You don't have the rights to access this page";
        $login = true;
        include_once('error.php');
        exit();
    }

}

?>
