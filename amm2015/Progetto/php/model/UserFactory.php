<?php

include_once 'User.php';
include_once 'Administrator.php';
include_once 'Artist.php';
include_once 'Utente.php';
include_once 'Db.php';

/**
 * UserFactory class
 *
 * @author Nicola Garau
 */
class UserFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new UserFactory();
        }

        return self::$singleton;
    }

    public function caricaUtente($username, $password) {


        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[loadUser] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        // find an admin
        $query = "select 
               administrator.id administrator_id,
               administrator.nome administrator_nome,
               administrator.cognome administrator_cognome,
               administrator.email administrator_email,
               administrator.citta administrator_citta,
               administrator.cap administrator_cap,
               administrator.via administrator_via,
               administrator.provincia administrator_provincia,
               administrator.numero_civico administrator_numero_civico,
               administrator.username administrator_username,
               administrator.password administrator_password
               
               from administrator 
               
               where administrator.username = ? and administrator.password = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
		
        $administrator = self::caricaAdministratorDaStmt($stmt);
        if (isset($administrator)) {
            // found an admin
            $mysqli->close();
            return $administrator;
        }
        
        //find an artist
        $query = "select 
               artist.username artist_username,
               artist.password artist_password,
               artist.nome artist_nome,
               artist.cognome artist_cognome,
               artist.email artist_email,
               artist.citta artist_citta,
               artist.id artist_id,
               artist.eta artist_eta,
               artist.caricamenti artist_caricamenti,
               artist.descrizione_personale artist_descrizione_personale
               
               from artist 
               
               where artist.username = ? and artist.password = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
		
        $artist = self::caricaArtistDaStmt($stmt);
        if (isset($artist)) {
            // found an artist
            $mysqli->close();
            return $artist;
        }
        
        //find user
        $query = "select 
               user.username user_username,
               user.password user_password,
               user.email user_email,
               user.citta user_citta,
               user.id user_id,
               user.eta user_eta
               
               from user 
               
               where user.username = ? and user.password = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
		
        $user = self::caricaUserDaStmt($stmt);
        if (isset($user)) {
            // found user
            $mysqli->close();
            return $user;
        }
    }

    public function &getListaAdministrator() {
        $administrator = array();
        $query = "select 
               administrator.id administrator_id,
               administrator.nome administrator_nome,
               administrator.cognome administrator_cognome,
               administrator.email administrator_email,
               administrator.citta administrator_citta,
               administrator.cap administrator_cap,
               administrator.via administrator_via,
               administrator.provincia administrator_provincia,
               administrator.numero_civico administrator_numero_civico,
               administrator.username administrator_username,
               administrator.password administrator_password
               
               from administrator";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaAdministrator] impossibile inizializzare il database");
            $mysqli->close();
            return $administrator;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaAdministrator] impossibile eseguire la query");
            $mysqli->close();
            return $administrator;
        }

        while ($row = $result->fetch_array()) {
            $administrator[] = self::creaAdministratorDaArray($row);
        }

        $mysqli->close();
        return $administrator;
    }
    
    public function &getListaUsers() {
        $users = array();
        $query = "select 	administrator.username administrator_username,
							administrator.email administrator_email,
							administrator.citta administrator_citta
		
							from administrator 
					union 
					select  user.username user_username,
							user.email user_email,
							user.citta user_citta 

							from user 
					union 
					select  artist.username artist_username,
							artist.email artist_email,
							artist.citta artist_citta  

							from artist";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaAdministrator] impossibile inizializzare il database");
            $mysqli->close();
            return $users;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaAdministrator] impossibile eseguire la query");
            $mysqli->close();
            return $users;
        }

        while ($row = $result->fetch_array()) {
            $users[] = self::creaGenericUserDaArray($row);
        }

        $mysqli->close();
        return $users;
    }

    public function cercaUtentePerId($id, $role) {
        $intval = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaUtentePerId] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        switch ($role) {
            
            case User::Administrator: 
                $query = "select 
               administrator.id administrator_id,
               administrator.nome administrator_nome,
               administrator.cognome administrator_cognome,
               administrator.email administrator_email,
               administrator.citta administrator_citta,
               administrator.cap administrator_cap,
               administrator.via administrator_via,
               administrator.provincia administrator_provincia,
               administrator.numero_civico administrator_numero_civico,
               administrator.username administrator_username,
               administrator.password administrator_password
               
               from administrator 
               
               where administrator.id = ?";

                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[loadUser] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                $toRet =  self::caricaAdministratorDaStmt($stmt);
                $mysqli->close();
                return $toRet;
                break;
                
            case User::Artist: 
                $query = "select 
               artist.username artist_username,
               artist.password artist_password,
               artist.nome artist_nome,
               artist.cognome artist_cognome,
               artist.email artist_email,
               artist.citta artist_citta,
               artist.id artist_id,
               artist.eta artist_eta,
               artist.caricamenti artist_caricamenti,
               artist.descrizione_personale artist_descrizione_personale
               
               from artist 
               
               where artist.id = ?";

                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[loadUser] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                $toRet =  self::caricaArtistDaStmt($stmt);
                $mysqli->close();
                return $toRet;
                break;
                
            case User::Utente: 
                $query = "select 
               user.username user_username,
               user.password user_password,
               user.email user_email,
               user.citta user_citta,
               user.id user_id,
               user.eta user_eta
               
               from user 
               
               where user.id = ?";

                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[loadUser] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                $toRet =  self::caricaUserDaStmt($stmt);
                $mysqli->close();
                return $toRet;
                break;

            default: return null;
        }
    }

    public function creaAdministratorDaArray($row) {
        $administrator = new Administrator();
        $administrator->setId($row['administrator_id']);
        $administrator->setNome($row['administrator_nome']);
        $administrator->setCognome($row['administrator_cognome']);
        $administrator->setEmail($row['administrator_email']);
        $administrator->setCap($row['administrator_cap']);
        $administrator->setCitta($row['administrator_citta']);
        $administrator->setVia($row['administrator_via']);
        $administrator->setProvincia($row['administrator_provincia']);
        $administrator->setNumeroCivico($row['administrator_numero_civico']);
        $administrator->setRuolo(User::Administrator);
        $administrator->setUsername($row['administrator_username']);
        $administrator->setPassword($row['administrator_password']);

        return $administrator;
    }
    
    public function creaGenericUserDaArray($row) {
        $guser = new User();
        $guser->setEmail($row['administrator_email']);
        $guser->setCitta($row['administrator_citta']);
        $guser->setUsername($row['administrator_username']);

        return $guser;
    }
    
    public function creaUserDaArray($row) {
        $utente = new Utente();
        $utente->setUsername($row['user_username']);
        $utente->setPassword($row['user_password']);
        $utente->setEmail($row['user_email']);
        $utente->setCitta($row['user_citta']);
        $utente->setId($row['user_id']);
        $utente->setEta($row['user_eta']);
        $utente->setRuolo(User::Utente);

        return $utente;
    }
    
    public function creaArtistaDaArray($row) {
        $artist = new Artist();
        $artist->setUsername($row['artist_username']);
        $artist->setPassword($row['artist_password']);
        $artist->setNome($row['artist_nome']);
        $artist->setCognome($row['artist_cognome']);
        $artist->setEmail($row['artist_email']);
        $artist->setCitta($row['artist_citta']);
        $artist->setId($row['artist_id']);
        
        $artist->setEta($row['artist_citta']);
        $artist->setCaricamenti($row['artist_caricamenti']);
        $artist->setDescrizionePersonale($row['artist_descrizione_personale']);
        $artist->setRuolo(User::Artist);

        return $artist;
    }

    public function salva(User $user) {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }

        $stmt = $mysqli->stmt_init();
        $count = 0;
        switch ($user->getRuolo()) {
            case User::Administrator:
                $count = $this->salvaAdministrator($user, $stmt); 
                break;
            case User::Artist:
                $count = $this->salvaArtist($user, $stmt);
                break;
            case User::Utente:
                $count = $this->salvaUtente($user, $stmt);
                break;
        }

        $stmt->close();
        $mysqli->close();
        return $count;
    }
    
     private function salvaAdministrator(Administrator $a, mysqli_stmt $stmt) {
        $query = " update administrator set 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    email = ?,
                    citta = ?,
                    provincia = ?,
                    cap = ?,
                    via = ?,
                    numero_civico = ?
                    
                    where administrator.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaAdministrator] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('ssssssssii', 
                $a->getPassword(), 
                $a->getNome(), 
                $a->getCognome(), 
                $a->getEmail(), 
                $a->getCitta(),
                $a->getProvincia(),
                $a->getCap(), 
                $a->getVia(), 
                $a->getNumeroCivico(), 
                $a->getId())) {
            error_log("[salvaAdministrator] impossibile" .
                    " effettuare il binding in input");
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[caricaIscritti] impossibile" .
                    " eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    private function salvaArtist(Artist $a, mysqli_stmt $stmt) {
        $query = " update artist set 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    email = ?,
                    citta = ?,
                    eta = ?,
                    caricamenti = ?,
                    descrizione_personale = ?
                    
                    where artist.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaArtist] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('sssssissi', 
                $a->getPassword(), 
                $a->getNome(), 
                $a->getCognome(), 
                $a->getEmail(), 
                $a->getCitta(),
                $a->getEta(),
                $a->getCaricamenti(), 
                $a->getDescrizionePersonale(),  
                $a->getId())) {
            error_log("[salvaArtist] impossibile" .
                    " effettuare il binding in input");
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[caricaIscritti] impossibile" .
                    " eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    private function salvaUtente(Utente $u, mysqli_stmt $stmt) {
        $query = " update user set 
                    password = ?,
                    email = ?,
                    citta = ?,
                    eta = ?
                    
                    where user.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaUtente] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('sssii', 
                $u->getPassword(),
                $u->getEmail(), 
                $u->getCitta(),
                $u->getEta(), 
                $u->getId())) {
            error_log("[salvaUtente] impossibile" .
                    " effettuare il binding in input");
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[caricaIscritti] impossibile" .
                    " eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    private function caricaAdministratorDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaAdministratorDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['administrator_id'], 
                $row['administrator_nome'], 
                $row['administrator_cognome'], 
                $row['administrator_email'], 
                $row['administrator_citta'],
                $row['administrator_cap'],
                $row['administrator_via'],
                $row['administrator_provincia'], 
                $row['administrator_numero_civico'],
                $row['administrator_username'], 
                $row['administrator_password']);
        if (!$bind) {
            error_log("[caricaAdministratorDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaAdministratorDaArray($row);
    }
    
    private function caricaUserDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaAdministratorDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['user_username'], 
                $row['user_password'],
                $row['user_email'], 
                $row['user_citta'],
                $row['user_id'],
                $row['user_eta']);
        if (!$bind) {
            error_log("[caricaUserDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaUserDaArray($row);
    }
    
    private function caricaArtistDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaArtistDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result( 
                $row['artist_username'],
                $row['artist_password'],
                $row['artist_nome'], 
                $row['artist_cognome'], 
                $row['artist_email'], 
                $row['artist_citta'],
                $row['artist_id'],
                $row['artist_eta'],
                $row['artist_caricamenti'],
                $row['artist_descrizione_personale']);
        if (!$bind) {
            error_log("[caricaArtistDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaArtistaDaArray($row);
    }

}

?>
