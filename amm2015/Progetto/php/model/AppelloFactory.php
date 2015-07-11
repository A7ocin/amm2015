<?php

include_once 'Appello.php';
include_once 'UserFactory.php';
include_once 'InsegnamentoFactory.php';
include_once 'Studente.php';
include_once 'Docente.php';
include_once 'User.php';

/**
 * Classe per creare oggetti di tipo Appello
 *
 * @author Davide Spano
 */
class AppelloFactory {

    private static $singleton;
    
    private function __constructor(){
    }
    
    
    /**
     * Restiuisce un singleton per creare appelli
     * @return \AppelloFactory
     */
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new AppelloFactory();
        }
        
        return self::$singleton;
    }
    
    public function cercaAppelloPerId($appelloid){
        $appelli = array();
        $query = "select 
               appelli.id appelli_id,
               appelli.data appelli_data,
               appelli.capienza appelli_capienza,
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
               
               from appelli
               join insegnamenti on appelli.insegnamento_id = insegnamenti.id
               join docenti on insegnamenti.docente_id = docenti.id 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id 
               join CdL on insegnamenti.cdl_id = CdL.id
               where appelli.id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaAppelloPerId] impossibile inizializzare il database");
            $mysqli->close();
            return $appelli;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaAppelloPerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $appelli;
        }

        
        if (!$stmt->bind_param('i', $appelloid)) {
            error_log("[cercaAppelloPerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $appelli;
        }

        $appelli =  self::caricaAppelliDaStmt($stmt);
        foreach($appelli as $appello){
            self::caricaIscritti($appello);
        }
        if(count($appelli > 0)){
            $mysqli->close();
            return $appelli[0];
        }else{
            $mysqli->close();
            return null;
        }
    }
    
    /**
     * Restituisce tutti gli appelli a cui uno studente e' iscritto
     * @param Studente $studente lo studente per la ricerca
     * @return array una lista di appelli (riferimento)
     */
    public function &getAppelliPerStudente(Studente $studente) {
        $appelli = array();
        $query = "select 
               appelli.id appelli_id,
               appelli.data appelli_data,
               appelli.capienza appelli_capienza,
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
               
               from appelli
               join insegnamenti on appelli.insegnamento_id = insegnamenti.id
               join docenti on insegnamenti.docente_id = docenti.id 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id 
               join CdL on insegnamenti.cdl_id = CdL.id
               where CdL.id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getAppelliPerStudente] impossibile inizializzare il database");
            $mysqli->close();
            return $appelli;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getAppelliPerStudente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $appelli;
        }

        
        if (!$stmt->bind_param('i', $studente->getCorsoDiLaurea()->getId())) {
            error_log("[getAppelliPerStudente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $appelli;
        }

        $appelli =  self::caricaAppelliDaStmt($stmt);
        foreach($appelli as $appello){
            self::caricaIscritti($appello);
        }
        $mysqli->close();
        return $appelli;
    }

    
    /**
     * Restituisce tutti gli appelli inseriti da un dato Docente
     * @param Docente $docente il docente per la ricerca
     * @return array una lista di appelli (riferimento)
     */
    public function &getAppelliPerDocente(Docente $docente) {
       $appelli = array();
        
        $query = "select 
               appelli.id appelli_id,
               appelli.data appelli_data,
               appelli.capienza appelli_capienza,
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
               
               from appelli
               join insegnamenti on appelli.insegnamento_id = insegnamenti.id
               join docenti on insegnamenti.docente_id = docenti.id 
               join dipartimenti on docenti.dipartimento_id = dipartimenti.id 
               join CdL on insegnamenti.cdl_id = CdL.id
               where docenti.id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getAppelliPerDocente] impossibile inizializzare il database");
            $mysqli->close();
            return $appelli;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getAppelliPerDocente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $docente->getId())) {
            error_log("[getAppelliPerDocente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $appelli =  self::caricaAppelliDaStmt($stmt);
        foreach($appelli as $appello){
            self::caricaIscritti($appello);
        }
        $mysqli->close();
        return $appelli;
    }
    
    private function &caricaAppelliDaStmt(mysqli_stmt $stmt){
        $appelli = array();
         if (!$stmt->execute()) {
            error_log("[caricaInsegnamentoDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['appello_id'],
                $row['appello_data'],
                $row['appello_capienza'],
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
            $appelli[] = self::creaDaArray($row);
        }
        
        $stmt->close();
        
        return $appelli;
    }

    public function creaDaArray($row){
        $appello = new Appello();
        $appello->setId($row['appello_id']);
        $appello->setCapienza($row['appello_capienza']);
        $appello->setData(new DateTime($row['appello_data']));
        $appello->setInsegnamento(InsegnamentoFactory::instance()->creaDaArray($row));
        return $appello;
    }
    
    public function caricaIscritti(Appello $appello){
        
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
            
            from appelli_studenti
            join studenti on studenti.id = appelli_studenti.studente_id
            join CdL on studenti.cdl_id = CdL.id
            join dipartimenti on CdL.dipartimento_id = dipartimenti.id
            where appelli_studenti.appello_id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaStudentePerMatricola] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[caricaIscritti] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $appello->getId())) {
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
                $row['dipartimenti_nome']);
        if (!$bind) {
            error_log("[caricaIscritti] impossibile" .
                    " effettuare il binding in output");
            $mysqli->close();
            return null;
        }

        while ($stmt->fetch()) {
            $appello->iscrivi(UserFactory::instance()->creaStudenteDaArray($row));
        }
        
        $mysqli->close();
        $stmt->close();
        
    }
    
    public function aggiungiIscrizione(Studente $s, Appello $a){
        $query = "insert into appelli_studenti (studente_id, appello_id) values (?, ?)";
        return $this->queryIscrizione($s, $a, $query);
    }
    
    public function cancellaIscrizione(Studente $s, Appello $a){
        $query = "delete from appelli_studenti where studente_id = ? and appello_id = ?";
        return $this->queryIscrizione($s, $a, $query);
    }
    
    private function queryIscrizione(Studente $s, Appello $a, $query){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[aggiungiIscrizione] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[aggiungiIscrizione] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param("ii", $s->getId(), $a->getId())) {
            error_log("[aggiungiIscrizione] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[aggiungiIscrizione] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }
        $mysqli->close();
        return $stmt->affected_rows;
    }
    
    public function salva(Appello $appello){
         $query = "update appelli set 
                    data = ?,
                    insegnamento_id = ?,
                    capienza = ?
                    where appelli.id = ?";
        return $this->modificaDB($appello, $query);
        
    }
    
    public function nuovo(Appello $appello){
        $query = "insert into appelli (data, insegnamento_id, capienza, id)
                  values (?, ?, ?, ?)";
        return $this->modificaDB($appello, $query);
    }
    
    public function cancella(Appello $appello){
        $query = "delete from appelli where data = ? and 
                  insegnamento_id = ? and capienza = ? and id = ?";
        return $this->modificaDB($appello, $query);
    }
    
    private function modificaDB(Appello $appello, $query){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            return 0;
        }

        $stmt = $mysqli->stmt_init();
       
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[modificaDB] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('siii', 
                $appello->getData()->format('Y-m-d'),
                $appello->getInsegnamento()->getId(),
                $appello->getCapienza(),
                $appello->getId())) {
            error_log("[modificaDB] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[modificaDB] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
    }
    
    
}

?>
