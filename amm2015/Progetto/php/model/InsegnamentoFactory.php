<?php

include_once 'Docente.php';
include_once 'UserFactory.php';
include_once 'Insegnamento.php';

/**
 * Classe per creare liste di Insegnamenti
 *
 * @author amm
 */
class InsegnamentoFactory {

    
    private static $singleton;
    
    private function __constructor(){
    }
    
    
    /**
     * Restiuisce un singleton per creare Insegnamenti
     * @return \InsegnamentoFactory
     */
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new InsegnamentoFactory();
        }
        
        return self::$singleton;
    }
    /**
     * Restituisce la lista di tutti gli insegnamenti presenti nel sistema
     * @return array|\Insegnamento
     */
    public function &getListaInsegnamenti() {
        $insegnamenti = array();
        
        $query = "select 
               insegnamenti.id insegnamenti_id,
               insegnamenti.titolo insegnamenti_titolo,
               insegnamenti.cfu insegnamenti_cfu,
               insegnamenti.codice insegnamenti_codice,

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
               dipartimenti.nome dipartimenti_nome,
               CdL.id CdL_id
               
               from insegnamenti
               join docenti on insegnamenti.docente_id = docenti.id 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id 
               join CdL on insegnamenti.cdl_id = CdL.id";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaInsegnamenti] impossibile inizializzare il database");
            $mysqli->close();
            return $insegnamenti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaInsegnamenti] impossibile eseguire la query");
            $mysqli->close();
            return $insegnamenti;
        }

        while ($row = $result->fetch_array()) {
            $insegnamenti[] = self::creaDaArray($row);
        }
        
        $mysqli->close();
        return $insegnamenti;
        
    }

    /**
     * Crea un insegnamento a partire dal codice
     * @param string $codice
     * @return Insegnamento
     */
    public function creaInsegnamentoDaCodice($codice) {
        
        
        $query = "select 
               insegnamenti.id insegnamenti_id,
               insegnamenti.titolo insegnamenti_titolo,
               insegnamenti.cfu insegnamenti_cfu,
               insegnamenti.codice insegnamenti_codice,

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
               dipartimenti.nome dipartimenti_nome,
               CdL.id CdL_id,
               CdL.nome CdL_nome,
               CdL.codice CdL_codice
               from insegnamenti
               join docenti on insegnamenti.docente_id = docenti.id 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id 
               join CdL on insegnamenti.cdl_id = CdL.id
               where insegnamenti.codice = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[creaInsegnamentoDaCodice] impossibile inizializzare il database");
            $mysqli->close();
            return $insegnamenti;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[creaInsegnamentoDaCodice] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('s', $codice)) {
            error_log("[creaInsegnamentoDaCodice] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $insegnamenti = self::caricaInsegnamentiDaStmt($stmt);
        if(count($insegnamenti) > 0){
            $mysqli->close();
            return $insegnamenti[0];
        }else{
            $mysqli->close();
            return null;
        }
    }

    /**
     * Restituisce la lista di Insegnamenti associati ad un Docente
     * @param Docente $docente il Docente in questione
     * @return \Insegnamento
     */
    public function &getListaInsegnamentiPerDocente(Docente $docente) {
        $insegnamenti = array();
        
        $query = "select 
               insegnamenti.id insegnamenti_id,
               insegnamenti.titolo insegnamenti_titolo,
               insegnamenti.cfu insegnamenti_cfu,
               insegnamenti.codice insegnamenti_codice,

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
               dipartimenti.nome dipartimenti_nome,
               CdL.id CdL_id,
               CdL.nome CdL_nome,
               CdL.codice CdL_codice
               
               from insegnamenti
               join docenti on insegnamenti.docente_id = docenti.id 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id 
               join CdL on insegnamenti.cdl_id = CdL.id
               where docenti.id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaInsegnamentiPerDocente] impossibile inizializzare il database");
            $mysqli->close();
            return $insegnamenti;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getListaInsegnamentiPerDocente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $docente->getId())) {
            error_log("[getListaInsegnamentiPerDocente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        return self::caricaInsegnamentiDaStmt($stmt);
    }
    
    /**
     * Crea un insegnamento a partire da una riga del DB
     * @param type $row
     */
    public function creaDaArray(&$row){
        $insegnamento = new Insegnamento();
        $insegnamento->setId($row['insegnamenti_id']);
        $insegnamento->setCfu($row['insegnamenti_cfu']);
        $insegnamento->setCodice($row['insegnamenti_codice']);
        $insegnamento->setTitolo($row['insegnamenti_titolo']);
        if(isset($row['docenti_id'])){
            $insegnamento->setDocente(UserFactory::instance()->creaDocenteDaArray($row));
        }
        if(isset($row['insegnamenti_id'])){
            $insegnamento->setCorsoDiLaurea(CorsoDiLaureaFactory::instance()->creaDaArray($row));
        }
        return $insegnamento;
    }
    
    /**
     * Carica una lista di insegnamenti dal db, tramite un prepared statement
     * @param mysqli_stmt $stmt
     * @return una lista di insegnamenti
     */
    private static function &caricaInsegnamentiDaStmt(mysqli_stmt $stmt){
        $insegnamenti = array();
         if (!$stmt->execute()) {
            error_log("[caricaInsegnamentoDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['insegnamenti_id'],
                $row['insegnamenti_titolo'],
                $row['insegnamenti_cfu'],
                $row['insegnamenti_codice'],
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
                $row['dipartimenti_nome'],
                $row['CdL_id'],
                $row['CdL_nome'],
                $row['CdL_codice']);
        if (!$bind) {
            error_log("[caricaInsegnamentoDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $insegnamenti[] = self::creaDaArray($row);
        }
        
        $stmt->close();
        
        return $insegnamenti;
    }

}

?>
