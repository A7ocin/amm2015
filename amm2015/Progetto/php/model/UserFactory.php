<?php

include_once 'User.php';
include_once 'Docente.php';
include_once 'Studente.php';
include_once 'Administrator.php';
include_once 'Artist.php';
include_once 'Utente.php';
include_once 'CorsoDiLaureaFactory.php';
include_once 'DipartimentoFactory.php';

/**
 * Classe per la creazione degli utenti del sistema
 *
 * @author Davide Spano
 */
class UserFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare utenti
     * @return \UserFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new UserFactory();
        }

        return self::$singleton;
    }

    /**
     * Carica un utente tramite username e password
     * @param string $username
     * @param string $password
     * @return \User|\Docente|\Studente
     */
    public function caricaUtente($username, $password) {


        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[loadUser] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        /*// cerco prima nella tabella studenti
        $query = "select studenti.id studenti_id,
            studenti.nome studenti_nome,
            studenti.cognome studenti_cognome,
            studenti.matricola studenti_matricola,
            studenti.email studenti_email,
            studenti.citta studenti_citta,
            studenti.via studenti_via,
            studenti.cap studenti_cap,
            studenti.provincia studenti_provincia,
            studenti.numero_civico studenti_numero_civico,
            studenti.username studenti_username,
            studenti.password studenti_password,
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
            from studenti 
            join CdL on studenti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where studenti.username = ? and studenti.password = ?";
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

        $studente = self::caricaStudenteDaStmt($stmt);
        if (isset($studente)) {
            // ho trovato uno studente
            $mysqli->close();
            return $studente;
        }

        // ora cerco un docente
        $query = "select 
               docenti.id docenti_id,
               docenti.nome docenti_nome,
               docenti.cognome docenti_cognome,
               docenti.email docenti_email,
               docenti.citta docenti_citta,
               docenti.cap docenti_cap,
               docenti.via docenti_via,
               docenti.provincia docenti_provincia,
               docenti.numero_civico docenti_numero_civico,
               docenti.ricevimento docenti_ricevimento,
               docenti.username docenti_username,
               docenti.password docenti_password,
               dipartimenti.id dipartimenti_id,
               dipartimenti.nome dipartimenti_nome
               
               from docenti 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id
               where docenti.username = ? and docenti.password = ?";

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

        $docente = self::caricaDocenteDaStmt($stmt);
        if (isset($docente)) {
            // ho trovato un docente
            $mysqli->close();
            return $docente;
        }*/
        
        // ora cerco un admin
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
            // ho trovato un admin
            $mysqli->close();
            return $administrator;
        }
        
        //ora cerco un artista
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
            // ho trovato un artista
            $mysqli->close();
            return $artist;
        }
        
        //pra cerco un utente
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
            // ho trovato un utente
            $mysqli->close();
            return $user;
        }
    }

    /**
     * Restituisce un array con i Docenti presenti nel sistema
     * @return array
     */
    public function &getListaDocenti() {
        $docenti = array();
        $query = "select 
               docenti.id docenti_id,
               docenti.nome docenti_nome,
               docenti.cognome docenti_cognome,
               docenti.email docenti_email,
               docenti.citta docenti_citta,
               docenti.cap docenti_cap,
               docenti.via docenti_via,
               docenti.provincia docenti_provincia,
               docenti.numero_civico docenti_numero_civico,
               docenti.ricevimento docenti_ricevimento,
               docenti.username docenti_username,
               docenti.password docenti_password,
               dipartimenti.id dipartimenti_id,
               dipartimenti.nome dipartimenti_nome
               
               from docenti 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaDocenti] impossibile inizializzare il database");
            $mysqli->close();
            return $docenti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaDocenti] impossibile eseguire la query");
            $mysqli->close();
            return $docenti;
        }

        while ($row = $result->fetch_array()) {
            $docenti[] = self::creaDocenteDaArray($row);
        }

        $mysqli->close();
        return $docenti;
    }
    
    /**
     * Restituisce un array con gli admin presenti nel sistema
     * @return array
     */
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

    /**
     * Restituisce la lista degli studenti presenti nel sistema
     * @return array
     */
    public function &getListaStudenti() {
        $studenti = array();
        $query = "select * from studenti " .
                "join CdL on cdl_id = CdL.id" .
                "join dipartimenti on CdL.dipartimento_id = dipartimenti.id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaStudenti] impossibile inizializzare il database");
            $mysqli->close();
            return $studenti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaStudenti] impossibile eseguire la query");
            $mysqli->close();
            return $studenti;
        }

        while ($row = $result->fetch_array()) {
            $studenti[] = self::creaStudenteDaArray($row);
        }

        return $studenti;
    }

    /**
     * Carica uno studente dalla matricola
     * @param int $matricola la matricola da cercare
     * @return Studente un oggetto Studente nel caso sia stato trovato,
     * NULL altrimenti
     */
    public function cercaStudentePerMatricola($matricola) {


        $intval = filter_var($matricola, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }

        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaStudentePerMatricola] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        $query = "select studenti.id studenti_id,
            studenti.nome studenti_nome,
            studenti.cognome studenti_cognome,
            studenti.matricola studenti_matricola,
            studenti.email studenti_email,
            studenti.citta studenti_citta,
            studenti.via studenti_via,
            studenti.cap studenti_cap,
            studenti.provincia studenti_provincia,
            studenti.numero_civico studenti_numero_civico,
            studenti.username studenti_username,
            studenti.password studenti_password,
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
            from studenti 
            join CdL on studenti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where studenti.matricola = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaStudentePerMatricola] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $intval)) {
            error_log("[cercaStudentePerMatricola] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $toRet =  self::caricaStudenteDaStmt($stmt);
        $mysqli->close();
        return $toRet;
    }

    /**
     * Cerca uno studente per id
     * @param int $id
     * @return Studente un oggetto Studente nel caso sia stato trovato,
     * NULL altrimenti
     */
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
            case User::Studente:
                $query = "select 
            studenti.id studenti_id,
            studenti.nome studenti_nome,
            studenti.cognome studenti_cognome,
            studenti.matricola studenti_matricola,
            studenti.email studenti_email,
            studenti.citta studenti_citta,
            studenti.via studenti_via,
            studenti.cap studenti_cap,
            studenti.provincia studenti_provincia, 
            studenti.numero_civico studenti_numero_civico,
            studenti.username studenti_username,
            studenti.password studenti_password,
            
            CdL.id CdL_id,
            CdL.nome CdL_nome,
            CdL.codice CdL_codice,
            
            dipartimenti.id dipartimenti_id,
            dipartimenti.nome dipartimenti_nome
            
            from studenti 
            join CdL on studenti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where studenti.id = ?";
                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("[cercaUtentePerId] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                return self::caricaStudenteDaStmt($stmt);
                break;
                
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

            case User::Docente:
                $query = "select 
               docenti.id docenti_id,
               docenti.nome docenti_nome,
               docenti.cognome docenti_cognome,
               docenti.email docenti_email,
               docenti.citta docenti_citta,
               docenti.cap docenti_cap,
               docenti.via docenti_via,
               docenti.provincia docenti_provincia,
               docenti.numero_civico docenti_numero_civico,
               docenti.ricevimento docenti_ricevimento,
               docenti.username docenti_username,
               docenti.password docenti_password,
               dipartimenti.id dipartimenti_id,
               dipartimenti.nome dipartimenti_nome
               
               from docenti 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id
               where docenti.id = ?";

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

                $toRet =  self::caricaDocenteDaStmt($stmt);
                $mysqli->close();
                return $toRet;
                break;

            default: return null;
        }
    }

    /**
     * Crea uno studente da una riga del db
     * @param type $row
     * @return \Studente
     */
    public function creaStudenteDaArray($row) {
        $studente = new Studente();
        $studente->setId($row['studenti_id']);
        $studente->setNome($row['studenti_nome']);
        $studente->setCognome($row['studenti_cognome']);
        $studente->setCitta($row['studenti_citta']);
        $studente->setCap($row['studenti_cap']);
        $studente->setVia($row['studenti_via']);
        $studente->setMatricola($row['studenti_matricola']);
        $studente->setEmail($row['studenti_email']);
        $studente->setProvincia($row['studenti_provincia']);
        $studente->setNumeroCivico($row['studenti_numero_civico']);
        $studente->setRuolo(User::Studente);
        $studente->setUsername($row['studenti_username']);
        $studente->setPassword($row['studenti_password']);

        if (isset($row['CdL_id']))
            $studente->setCorsoDiLaurea(CorsoDiLaureaFactory::instance()->creaDaArray($row));
        return $studente;
    }

    /**
     * Crea un docente da una riga del db
     * @param type $row
     * @return \Docente
     */
    public function creaDocenteDaArray($row) {
        $docente = new Docente();
        $docente->setId($row['docenti_id']);
        $docente->setNome($row['docenti_nome']);
        $docente->setCognome($row['docenti_cognome']);
        $docente->setEmail($row['docenti_email']);
        $docente->setCap($row['docenti_cap']);
        $docente->setCitta($row['docenti_citta']);
        $docente->setVia($row['docenti_via']);
        $docente->setProvincia($row['docenti_provincia']);
        $docente->setNumeroCivico($row['docenti_numero_civico']);
        $docente->setRicevimento($row['docenti_ricevimento']);
        $docente->setRuolo(User::Docente);
        $docente->setUsername($row['docenti_username']);
        $docente->setPassword($row['docenti_password']);

        $docente->setDipartimento(DipartimentoFactory::instance()->creaDaArray($row));
        return $docente;
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

    /**
     * Salva i dati relativi ad un utente sul db
     * @param User $user
     * @return il numero di righe modificate
     */
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
            case User::Studente:
                $count = $this->salvaStudente($user, $stmt);
                break;
            case User::Docente:
                $count = $this->salvaDocente($user, $stmt);
                break;
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

    /**
     * Rende persistenti le modifiche all'anagrafica di uno studente sul db
     * @param Studente $s lo studente considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaStudente(Studente $s, mysqli_stmt $stmt) {
        $query = " update studenti set 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    email = ?,
                    numero_civico = ?,
                    citta = ?,
                    provincia = ?,
                    matricola = ?,
                    cap = ?,
                    via = ?
                    where studenti.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaStudente] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('ssssississi', $s->getPassword(), $s->getNome(), $s->getCognome(), $s->getEmail(), $s->getNumeroCivico(), $s->getCitta(), $s->getProvincia(), $s->getMatricola(), $s->getCap(), $s->getVia(), $s->getId())) {
            error_log("[salvaStudente] impossibile" .
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
    
    /**
     * Rende persistenti le modifiche all'anagrafica di un docente sul db
     * @param Docente $d il docente considerato
     * @param mysqli_stmt $stmt un prepared statement
     * @return int il numero di righe modificate
     */
    private function salvaDocente(Docente $d, mysqli_stmt $stmt) {
        $query = " update docenti set 
                    password = ?,
                    nome = ?,
                    cognome = ?,
                    email = ?,
                    citta = ?,
                    provincia = ?,
                    cap = ?,
                    via = ?,
                    ricevimento = ?,
                    numero_civico = ?,
                    dipartimento_id = ?
                    where docenti.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[salvaStudente] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('sssssssssiii', 
                $d->getPassword(), 
                $d->getNome(), 
                $d->getCognome(), 
                $d->getEmail(), 
                $d->getCitta(),
                $d->getProvincia(),
                $d->getCap(), 
                $d->getVia(), 
                $d->getRicevimento(),
                $d->getNumeroCivico(), 
                $d->getDipartimento()->getId(),
                $d->getId())) {
            error_log("[salvaStudente] impossibile" .
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

    /**
     * Carica un docente eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaDocenteDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaDocenteDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['docenti_id'], 
                $row['docenti_nome'], 
                $row['docenti_cognome'], 
                $row['docenti_email'], 
                $row['docenti_citta'],
                $row['docenti_cap'],
                $row['docenti_via'],
                $row['docenti_provincia'], 
                $row['docenti_numero_civico'],
                $row['docenti_ricevimento'],
                $row['docenti_username'], 
                $row['docenti_password'], 
                $row['dipartimenti_id'], 
                $row['dipartimenti_nome']);
        if (!$bind) {
            error_log("[caricaDocenteDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaDocenteDaArray($row);
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

    /**
     * Carica uno studente eseguendo un prepared statement
     * @param mysqli_stmt $stmt
     * @return null
     */
    private function caricaStudenteDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("[caricaStudenteDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['studenti_id'], $row['studenti_nome'], $row['studenti_cognome'], $row['studenti_matricola'], $row['studenti_email'], $row['studenti_citta'], $row['studenti_via'], $row['studenti_cap'], $row['studenti_provincia'], $row['studenti_numero_civico'], $row['studenti_username'], $row['studenti_password'], $row['CdL_id'], $row['CdL_nome'], $row['CdL_codice'], $row['dipartimenti_id'], $row['dipartimenti_nome']);
        if (!$bind) {
            error_log("[caricaStudenteDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaStudenteDaArray($row);
    }

}

?>
