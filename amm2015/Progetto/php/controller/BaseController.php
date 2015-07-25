<?php

include_once basename(__DIR__) . '/../view/ViewDescriptor.php';
include_once basename(__DIR__) . '/../model/User.php';
include_once basename(__DIR__) . '/../model/UserFactory.php';

/**
 * This is the controller used by the not logged users 
 *
 * @author Nicola Garau
 */
class BaseController {

    const user = 'user';
    const role = 'role';
    const impersonato = '_imp';

    /**
     * Constructor
     */
    public function __construct() {
        
    }

    /**
     * This method handles the user's input 
     * @param type $request the request
     */
    public function handleInput(&$request) {
        // create the view descriptor
        $vd = new ViewDescriptor();
        
        // set page
        $vd->setPagina($request['page']);

        // switch between commands
        if (isset($request["cmd"])) {
            // command received
            switch ($request["cmd"]) {
                case 'login':
                    $username = isset($request['user']) ? $request['user'] : '';
                    $password = isset($request['password']) ? $request['password'] : '';
                    $this->login($vd, $username, $password);
                    // this variable will be used by the view
                    if ($this->loggedIn())
                        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
                    break;
					
                default : $this->showLoginPage();
            }
        } else {
            if ($this->loggedIn()) {
                // authentication done
                $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);

                $this->showHomeUtente($vd);
            } else {
                // user not logged in 
                $this->showLoginPage($vd);
            }
        }

        // call the view
        require basename(__DIR__) . '/../view/master.php';
    }

    /**
     * Verify if the user is logged in
     * @return boolean true if the user is logged in, false otherwise
     */
    protected function loggedIn() {
        return isset($_SESSION) && array_key_exists(self::user, $_SESSION);
    }

    /**
     * Set master.php view for the login
     * @param ViewDescriptor $vd the view descriptor
     */
    protected function showLoginPage($vd) {
        // show login page
        $vd->setTitolo("TTDM - login");
        $vd->setMenuFile(basename(__DIR__) . '/../view/login/menu.php');
        $vd->setLogoFile(basename(__DIR__) . '/../view/login/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/login/leftBar.php');
        $vd->setRightBarFile(basename(__DIR__) . '/../view/login/rightBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/login/content.php');
    }
	
	 protected function showHomeAdministrator($vd) {
        // show admins' home
        $vd->setTitolo("TTDM - Administrator page");
        $vd->setMenuFile(basename(__DIR__) . '/../view/administrator/menu.php');
        $vd->setLogoFile(basename(__DIR__) . '/../view/administrator/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/administrator/leftBar.php');
        $vd->setRightBarFile(basename(__DIR__) . '/../view/administrator/rightBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/administrator/content.php');
    }
    
    protected function showHomeArtist($vd) {
        // show artists' home
        $vd->setTitolo("TTDM - Artist page");
        $vd->setMenuFile(basename(__DIR__) . '/../view/artist/menu.php');
        $vd->setLogoFile(basename(__DIR__) . '/../view/artist/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/artist/leftBar.php');
        $vd->setRightBarFile(basename(__DIR__) . '/../view/artist/rightBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/artist/content.php');
    }
    
    protected function showHomeUser($vd) {
        // show users' home
        $vd->setTitolo("TTDM - User page");
        $vd->setMenuFile(basename(__DIR__) . '/../view/user/menu.php');
        $vd->setLogoFile(basename(__DIR__) . '/../view/user/logo.php');
        $vd->setLeftBarFile(basename(__DIR__) . '/../view/user/leftBar.php');
        $vd->setRightBarFile(basename(__DIR__) . '/../view/user/rightBar.php');
        $vd->setContentFile(basename(__DIR__) . '/../view/user/content.php');
    }

    /**
     * Switch between roles to select the homepage
     * @param ViewDescriptor $vd the view descriptor
     */
    protected function showHomeUtente($vd) {
        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
        switch ($user->getRuolo()) {
            case User::Administrator:
                $this->showHomeAdministrator($vd);
                break;
                
            case User::Artist:
                $this->showHomeArtist($vd);
                break;
                
            case User::Utente:
                $this->showHomeUser($vd);
                break;
        }
    }
    
    /**
     * Imposta la variabile del descrittore della vista legato 
     * all'utente da impersonare nel caso sia stato specificato nella richiesta
     * @param ViewDescriptor $vd il descrittore della vista
     * @param array $request la richiesta
     */
    protected function setImpToken(ViewDescriptor $vd, &$request) {

        if (array_key_exists('_imp', $request)) {
            $vd->setImpToken($request['_imp']);
        }
    }

    /**
     * Authentication procedure
     * @param ViewDescriptor $vd The view descriptor
     * @param string $username the username
     * @param string $password the password
     */
    protected function login($vd, $username, $password) {
        // set user data

        $user = UserFactory::instance()->caricaUtente($username, $password);
        if (isset($user) && $user->esiste()) {
            // authentication done
            $_SESSION[self::user] = $user->getId();
            $_SESSION[self::role] = $user->getRuolo();
            $this->showHomeUtente($vd);
        } else {
            $vd->setMessaggioErrore("Unknown user or wrong password");
            $this->showLoginPage($vd);
        }
    }

    /**
     * Logout procedure
     * @param type $vd The view descriptor
     */
    protected function logout($vd) {
        $_SESSION = array();
        // End of cookies' validity
        if (session_id() != '' || isset($_COOKIE[session_name()])) {
            // go back by a month
            setcookie(session_name(), '', time() - 2592000, '/');
        }
        // destroy session file
        session_destroy();
        $this->showLoginPage($vd);
    }

    /**
     * Update the address
     * @param User $user the user
     * @param array $request the request
     * @param array $msg an error array
     */
    protected function aggiornaIndirizzo($user, &$request, &$msg) {

        if (isset($request['via'])) {
            if (!$user->setVia($request['via'])) {
                $msg[] = '<li>The address is incorrect</li>';
            }
        }
        if (isset($request['civico'])) {
            if (!$user->setNumeroCivico($request['civico'])) {
                $msg[] = '<li>The address number is incorrect</li>';
            }
        }
        if (isset($request['citta'])) {
            if (!$user->setCitta($request['citta'])) {
                $msg[] = '<li>The city is incorrect</li>';
            }
        }
        if (isset($request['provincia'])) {
            if (!$user->setProvincia($request['provincia'])) {
                $msg[] = '<li>The district is incorrect</li>';
            }
        }
        if (isset($request['cap'])) {
            if (!$user->setCap($request['cap'])) {
                $msg[] = '<li>The zip code is incorrect</li>';
            }
        }
        if (isset($request['eta'])) {
            if (!$user->setEta($request['eta'])) {
                $msg[] = '<li>The age is incorrect</li>';
            }
        }
        if (isset($request['caricamenti'])) {
            if (!$user->setCaricamenti($request['caricamenti'])) {
                $msg[] = '<li>The uploads are incorrect</li>';
            }
        }
        if (isset($request['descrizione_personale'])) {
            if (!$user->setDescrizionePersonale($request['descrizione_personale'])) {
                $msg[] = '<li>The personal description is incorrect</li>';
            }
        }

        // save if there are not errors
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Sorry, I wasn\'t able to save :-(</li>';
            }
        }
    }

    /**
     * Update the email address
     * @param User $user the user
     * @param array $request the request
     * @param array $msg an error array
     */
    protected function aggiornaEmail($user, &$request, &$msg) {
        if (isset($request['email'])) {
            if (!$user->setEmail($request['email'])) {
                $msg[] = '<li>The email address is incorrect</li>';
            }
        }
        
        // save if there are not errors
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Sorry, I wasn\'t able to save :-(</li>';
            }
        }
    }

    /**
     * Update the password
     * @param User $user the user
     * @param array $request the request
     * @param array $msg an error array
     */
    protected function aggiornaPassword($user, &$request, &$msg) {
        if (isset($request['pass1']) && isset($request['pass2'])) {
            if ($request['pass1'] == $request['pass2']) {
                if (!$user->setPassword($request['pass1'])) {
                    $msg[] = '<li>The password\'s format is not correct</li>';
                }
            } else {
                $msg[] = '<li>The two passwords are not the same</li>';
            }
        }
        
        // save if there are not errors
        if (count($msg) == 0) {
            if (UserFactory::instance()->salva($user) != 1) {
                $msg[] = '<li>Sorry, I wasn\'t able to save :-(</li>';
            }
        }
    }

    /**
     * Create a feedback message for the user
     * @param array $msg the list of error messages
     * @param ViewDescriptor $vd the view descriptor
     * @param string $okMsg the 'ok' message
     */
    protected function creaFeedbackUtente(&$msg, $vd, $okMsg) {
        if (count($msg) > 0) {
            // something went wrong...
            $error = "The following errors have occurred \n<ul>\n";
            foreach ($msg as $m) {
                $error = $error . $m . "\n";
            }
            // set the error message
            $vd->setMessaggioErrore($error);
        } else {
            // set ok message
            $vd->setMessaggioConferma($okMsg);
        }
    }

}

?>
