<?php

include_once 'Esame.php';
include_once 'Studente.php';
include_once 'Docente.php';
include_once 'Insegnamento.php';
include_once 'UserFactory.php';
include_once 'InsegnamentoFactory.php';

/**
 * Classe per la creazione degli esami
 *
 * @author Davide Spano
 */
class EsameFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare Esami
     * @return \EsameFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new EsameFactory();
        }

        return self::$singleton;
    }

    /**
     * Restituisce la lista di esami per un dato studente
     * @param Studente $user
     */
    public function &esamiPerStudente(Studente $user) {
        $esami = array();
        $query = "select 
                  esami.id esami_id,
                  esami.voto esami_voto,
                  esami.data esami_data,
                  insegnamenti.id insegnamenti_id,
                  insegnamenti.titolo insegnamenti_titolo,
                  insegnamenti.cfu insegnamenti_cfu,
                  insegnamenti.codice insegnamenti_codice,
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
                  dipartimenti.nome dipartimenti_nome,
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
                  docenti.password docenti_password
                  


                  from esami 
                  join studenti on esami.studente_id = studenti.id
                  join insegnamenti on esami.insegnamento_id = insegnamenti.id
                  join CdL on studenti.cdl_id = CdL.id
                  join dipartimenti on CdL.dipartimento_id = dipartimenti.id
                  join docenti on insegnamenti.docente_id = docenti.id
                  where esami.studente_id = ?
                  ";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[esamiPerStudente] impossibile inizializzare il database");
            $mysqli->close();
            return $esami;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[esamiPerStudente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $esami;
        }

        if (!$stmt->bind_param('i', $user->getId())) {
            error_log("[esamiPerStudente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $esami;
        }

        $esami = self::caricaEsamiDaStmt($stmt);
        foreach ($esami as $esame) {
            $this->caricaCommissione($esame);
        }
        $mysqli->close();
        return $esami;
    }

    public function &esamePerDocente(Docente $user) {
        $esami = array();
        $query = "select 
                  esami.id esami_id,
                  esami.voto esami_voto,
                  esami.data esami_data,
                  insegnamenti.id insegnamenti_id,
                  insegnamenti.titolo insegnamenti_titolo,
                  insegnamenti.cfu insegnamenti_cfu,
                  insegnamenti.codice insegnamenti_codice,
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
                  dipartimenti.nome dipartimenti_nome,
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
                  docenti.password docenti_password
                  


                  from esami 
                  join studenti on esami.studente_id = studenti.id
                  join insegnamenti on esami.insegnamento_id = insegnamenti.id
                  join CdL on studenti.cdl_id = CdL.id
                  join dipartimenti on CdL.dipartimento_id = dipartimenti.id
                  join docenti on insegnamenti.docente_id = docenti.id
                  where docenti.id = ?
                  ";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[esamePerDocente] impossibile inizializzare il database");
            $mysqli->close();
            return $esami;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[esamePerDocente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $esami;
        }

        if (!$stmt->bind_param('i', $user->getId())) {
            error_log("[esamiPerStudente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $esami;
        }

        $esami = self::caricaEsamiDaStmt($stmt);
        foreach ($esami as $esame) {
            $this->caricaCommissione($esame);
        }
        $mysqli->close();
        return $esami;
    }
    
    public function &ricercaEsami(Docente $user, $insegnamento, 
            $matricola, $nome, $cognome) {
        $esami = array();
        
        // costruisco la where "a pezzi" a seconda di quante 
        // variabili sono definite
        $bind = "i";
        $where = " where docenti.id = ? ";
        $par = array();
        $par[] = $user->getId();
        
        if(isset($insegnamento)){
            $where .= " and insegnamenti.id = ? ";
            $bind .="i";
            $par[] = $insegnamento;
        }
        
        if(isset($matricola)){
            $where .= " and studenti.matricola = ? ";
            $bind .="s";
            $par[] = $matricola;
        }
        
        if(isset($nome)){
            $where .= " and lower(studenti.nome) like lower(?) ";
            $bind .="s";
            $par[] = "%".$nome."%";
        }
        
        if(isset($cognome)){
            $where .= " and lower(studenti.cognome) like lower(?) ";
            $bind .="s";
            $par[] = "%".$cognome."%";
        }
        
        
        
        
        
        
        $query = "select 
                  esami.id esami_id,
                  esami.voto esami_voto,
                  esami.data esami_data,
                  insegnamenti.id insegnamenti_id,
                  insegnamenti.titolo insegnamenti_titolo,
                  insegnamenti.cfu insegnamenti_cfu,
                  insegnamenti.codice insegnamenti_codice,
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
                  dipartimenti.nome dipartimenti_nome,
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
                  docenti.password docenti_password
                  


                  from esami 
                  join studenti on esami.studente_id = studenti.id
                  join insegnamenti on esami.insegnamento_id = insegnamenti.id
                  join CdL on studenti.cdl_id = CdL.id
                  join dipartimenti on CdL.dipartimento_id = dipartimenti.id
                  join docenti on insegnamenti.docente_id = docenti.id
                  ".$where;
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[ricercaEsami] impossibile inizializzare il database");
            $mysqli->close();
            return $esami;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[ricercaEsami] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $esami;
        }

        switch (count($par)) {
            case 1:
                if (!$stmt->bind_param($bind, $par[0])) {
                    error_log("[ricercaEsami] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $esami;
                }
                break;
            case 2:
                if (!$stmt->bind_param($bind, $par[0], $par[1])) {
                    error_log("[ricercaEsami] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $esami;
                }
                break;

            case 3:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2])) {
                    error_log("[ricercaEsami] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $esami;
                }
                break;

            case 4:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2], $par[3])) {
                    error_log("[ricercaEsami] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $esami;
                }
                break;

            case 5:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2], $par[3], $par[4])) {
                    error_log("[ricercaEsami] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $esami;
                }
                break;

           
        }

        $esami = self::caricaEsamiDaStmt($stmt);
        foreach ($esami as $esame) {
            $this->caricaCommissione($esame);
        }
        $mysqli->close();
        return $esami;
    }

    public function creaDaArray($row) {
        $esame = new Esame();
        $esame->setId($row['esami_id']);
        $esame->setData(new DateTime($row['esami_data']));
        $esame->setVoto($row['esami_voto']);
        $esame->setStudente(UserFactory::instance()->creaStudenteDaArray($row));
        $esame->setInsegnamento(InsegnamentoFactory::instance()->creaDaArray($row));
        return $esame;
    }

    public function caricaCommissione(Esame $esame) {
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
               
            from esami_docenti 
            join docenti on esami_docenti.docente_id = docenti.id
            join dipartimenti on docenti.dipartimento_id = dipartimenti.id
            where esami_docenti.esame_id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[caricaCommissione] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[caricaCommissione] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $esame->getId())) {
            error_log("[caricaIscritti] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        if (!$stmt->execute()) {
            error_log("[caricaIscritti] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
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
            $mysqli->close();
            return null;
        }

        while ($stmt->fetch()) {

            $esame->aggiungiMembroCommissione(UserFactory::instance()->creaDocenteDaArray($row));
        }

        $mysqli->close();
        $stmt->close();
    }

    public function &getEsami() {
        return self::esamePerDocente(new Docente());
    }

    public function &caricaEsamiDaStmt(mysqli_stmt $stmt) {
        $esami = array();
        if (!$stmt->execute()) {
            error_log("[caricaStudenteDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['esami_id'], 
                $row['esami_voto'], 
                $row['esami_data'], 
                $row['insegnamenti_id'], 
                $row['insegnamenti_titolo'], 
                $row['insegnamenti_cfu'], 
                $row['insegnamenti_codice'], 
                $row['studenti_id'], 
                $row['studenti_nome'], 
                $row['studenti_cognome'], 
                $row['studenti_matricola'], 
                $row['studenti_email'], 
                $row['studenti_citta'], 
                $row['studenti_via'], 
                $row['studenti_cap'], 
                $row['studenti_provincia'], 
                $row['studenti_numero_civico'], 
                $row['studenti_username'], 
                $row['studenti_password'], 
                $row['CdL_id'], 
                $row['CdL_nome'], 
                $row['CdL_codice'], 
                $row['dipartimenti_id'], 
                $row['dipartimenti_nome'], 
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
                $row['docenti_password']);
        if (!$bind) {
            error_log("[caricaEsamiDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $esami[] = self::creaDaArray($row);
        }

        $stmt->close();

        return $esami;
    }

    /**
     * Salva un elenco di esami sul DB
     * @param ElencoEsami $elenco l'elenco di esami da inserire
     * @return boolean true se il salvataggio va a buon fine, false altrimenti
     */
    public function salvaElenco(ElencoEsami $elenco) {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salvaElenco] impossibile inizializzare il database");
            $mysqli->close();
            return false;
        }
        $stmt = $mysqli->stmt_init();
        $stmt2 = $mysqli->stmt_init();

        $insert_esame = "insert into esami (id, studente_id, 
             insegnamento_id, voto, data) values (default, ?, ?, ?, ?)";
        $insert_commissione = "insert into esami_docenti (esame_id, docente_id)
            values (?,?)";
        $stmt->prepare($insert_esame);
        if (!$stmt) {
            error_log("[salvaElenco] impossibile" .
                    " inizializzare il prepared statement n 1");
            $mysqli->close();
            return false;
        }


        $stmt2->prepare($insert_commissione);
        if (!$stmt2) {
            error_log("[salvaElenco] impossibile" .
                    " inizializzare il prepared statement n 2");
            $mysqli->close();
            return false;
        }

        // variabili da collegare agli statements
        $studente_id = 0;
        $insegnamento_id = $elenco->getTemplate()->getInsegnamento()->getId();
        $voto = 0;
        $data = $elenco->getTemplate()->getData()->format('Y-m-d');

        $esame_id = 0;
        $docente_id = 0;

        if (!$stmt->bind_param('iiis', $studente_id, $insegnamento_id, $voto, $data)) {
            error_log("[salvaElenco] impossibile" .
                    " effettuare il binding in input stmt1");
            $mysqli->close();
            return false;
        }

        if (!$stmt2->bind_param('ii', $esame_id, $docente_id)) {
            error_log("[salvaElenco] impossibile" .
                    " effettuare il binding in input stmt1");
            $mysqli->close();
            return false;
        }
        // inizio la transazione
        $mysqli->autocommit(false);


        foreach ($elenco->getEsami() as $esame) {
            /* @var $esame Esame */

            // inserisco un esame

            $studente_id = $esame->getStudente()->getId();
            $voto = $esame->getVoto();

            if (!$stmt->execute()) {
                error_log("[salvaElenco] impossibile" .
                        " eseguire lo statement 1");
                $mysqli->rollback();
                $mysqli->close();
                return false;
            }


            // inserisco la commissione per l'esame
            $esame_id = $stmt->insert_id;
            foreach ($elenco->getTemplate()->getCommissione() as $commissario) {
                /* @var $commissario Docente */
                $docente_id = $commissario->getId();
                if (!$stmt2->execute()) {
                    error_log("[salvaElenco] impossibile" .
                            " eseguire lo statement 2");
                    $mysqli->rollback();
                    $mysqli->close();
                    return false;
                }
            }
        }

        // tutto ok, posso rendere persistente il salvataggio
        $mysqli->commit();
        $mysqli->autocommit(true);
        $mysqli->close();

        return true;
    }

}

?>
