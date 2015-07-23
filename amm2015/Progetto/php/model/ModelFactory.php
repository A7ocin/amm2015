<?php

include_once 'Appello.php';
include_once 'Model.php';
include_once 'UserFactory.php';
include_once 'InsegnamentoFactory.php';
include_once 'Studente.php';
include_once 'Docente.php';
include_once 'User.php';
include_once 'Administrator.php';
include_once 'Artist.php';
include_once 'Utente.php';

/**
 * Classe per creare oggetti di tipo Modello
 *
 * @author Nicola Garau
 */
class ModelFactory {

    private static $singleton;
    
    private function __constructor(){
    }
    
    
    /**
     * Restiuisce un singleton per creare modelli
     * @return \ModelFactory
     */
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new ModelFactory();
        }
        
        return self::$singleton;
    }
    
    public function cercaModelPerId($modelid){
        $models = array();
        $query = "select 
               models.id models_id,
               models.data models_data,
               models.dimensione models_dimensione,
               models.nome models_nome,
               models.uploader models_uploader,
               models.descrizione models_descrizione
               
               from models
               
               where models.id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaModelPerId] impossibile inizializzare il database");
            $mysqli->close();
            return $models;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaModelPerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $models;
        }

        
        if (!$stmt->bind_param('i', $modelid)) {
            error_log("[cercaModelPerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $models;
        }

        $models =  self::caricaModelliDaStmt($stmt);
        /*foreach($models as $model){
            self::caricaIscritti($model);
        }*/
        if(count($models > 0)){
            $mysqli->close();
            return $models[0];
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
     /*
    public function &getAppelliPerStudente(Studente $studente) {
        $models = array();
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
            return $models;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getAppelliPerStudente] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $models;
        }

        
        if (!$stmt->bind_param('i', $studente->getCorsoDiLaurea()->getId())) {
            error_log("[getAppelliPerStudente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $models;
        }

        $models =  self::caricaAppelliDaStmt($stmt);
        foreach($models as $model){
            self::caricaIscritti($model);
        }
        $mysqli->close();
        return $models;
    }*/
    
    //----------------------------------------------------------------------------------------------------------------------------
    
    public function &getModelsPerAdministrator(Administrator $admin) {
       $models = array();
        
        $query = "select 
               models.id models_id,
               models.data models_data,
               models.dimensione models_dimensione,
               models.nome models_nome,
               models.uploader models_uploader,
               models.descrizione models_descrizione
               
               from models";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getModelsPerAdministrator] impossibile inizializzare il database");
            $mysqli->close();
            return $models;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getModelsPerAdministrator] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        /*if (!$stmt->bind_param('i', $admin->getId())) {
            error_log("[getAppelliPerDocente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }*/

        $models =  self::caricaModelliDaStmt($stmt);
        /*foreach($models as $model){
            self::caricaIscritti($model);
        }*/
        $mysqli->close();
        return $models;
    }
    
    public function &getModelsPerArtist(Artist $artist) {
       $models = array();
        
        $query = "select 
               models.id models_id,
               models.data models_data,
               models.dimensione models_dimensione,
               models.nome models_nome,
               models.uploader models_uploader,
               models.descrizione models_descrizione
               
               from models";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getModelsPerArtist] impossibile inizializzare il database");
            $mysqli->close();
            return $models;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getModelsPerArtist] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        /*if (!$stmt->bind_param('i', $admin->getId())) {
            error_log("[getAppelliPerDocente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }*/

        $models =  self::caricaModelliDaStmt($stmt);
        /*foreach($models as $model){
            self::caricaIscritti($model);
        }*/
        $mysqli->close();
        return $models;
    }
    
    public function &getModelsPerUser(Utente $utente) {
       $models = array();
        
        $query = "select 
               models.id models_id,
               models.data models_data,
               models.dimensione models_dimensione,
               models.nome models_nome,
               models.uploader models_uploader,
               models.descrizione models_descrizione
               
               from models";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getModelsPerUsers] impossibile inizializzare il database");
            $mysqli->close();
            return $models;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getModelsPerUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        /*if (!$stmt->bind_param('i', $admin->getId())) {
            error_log("[getAppelliPerDocente] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }*/

        $models =  self::caricaModelliDaStmt($stmt);
        /*foreach($models as $model){
            self::caricaIscritti($model);
        }*/
        $mysqli->close();
        return $models;
    }

    
    /**
     * Restituisce tutti gli appelli inseriti da un dato Docente
     * @param Docente $docente il docente per la ricerca
     * @return array una lista di appelli (riferimento)
     */
    /*public function &getAppelliPerDocente(Docente $docente) {
       $models = array();
        
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
            return $models;
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

        $models =  self::caricaAppelliDaStmt($stmt);
        foreach($models as $model){
            self::caricaIscritti($model);
        }
        $mysqli->close();
        return $models;
    }*/
    
    /*private function &caricaAppelliDaStmt(mysqli_stmt $stmt){
        $models = array();
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
            $models[] = self::creaDaArray($row);
        }
        
        $stmt->close();
        
        return $models;
    }*/
    
    private function &caricaModelliDaStmt(mysqli_stmt $stmt){echo " (caricaModelliDaStmt) ";
        $models = array();
         if (!$stmt->execute()) {echo " ERRORE 1 ";
            error_log("[caricaModelliDaStmt] impossibile" .
                    " eseguire lo statement");
            $returnNull = null;
            return $returnNull;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['models_id'],
                $row['models_data'],
                $row['models_dimensione'],
                $row['models_nome'],
                $row['models_uploader'],
                $row['models_descrizione']);
        if (!$bind) {echo " ERRORE 2 ";
            error_log("[caricaInsegnamentoDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $models[] = self::creaDaArray($row);
        }
        
        $stmt->close();
        
        return $models;
    }

    public function creaDaArray($row){echo " (CreaDaArray) ";
        $model = new Model();
        $model->setId($row['models_id']);
        $model->setDimensione($row['models_dimensione']);
        $model->setNome($row['models_nome']);
        $model->setData(new DateTime($row['models_data']));
        $model->setUploader($row['models_uploader']);
        $model->setDescrizione($row['models_descrizione']);
        return $model;
    }
    
    /*public function caricaIscritti(Model $model){
        
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

        if (!$stmt->bind_param('i', $model->getId())) {
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
            $model->iscrivi(UserFactory::instance()->creaStudenteDaArray($row));
        }
        
        $mysqli->close();
        $stmt->close();
        
    }*/
    
    /*public function aggiungiIscrizione(Studente $s, Model $a){
        $query = "insert into appelli_studenti (studente_id, appello_id) values (?, ?)";
        return $this->queryIscrizione($s, $a, $query);
    }
    
    public function cancellaIscrizione(Studente $s, Model $a){
        $query = "delete from appelli_studenti where studente_id = ? and appello_id = ?";
        return $this->queryIscrizione($s, $a, $query);
    }
    
    private function queryIscrizione(Studente $s, Model $a, $query){
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
    }*/
    
    public function salva(Model $model){
         $query = "update models set 
					id = ?,
                    data = ?,
                    dimensione = ?,
                    nome = ?,
                    uploader = ?,
                    descrizione = ?
                    
                    where models.id = ?";
        return $this->modificaDB($model, $query);
        
    }
    
    public function nuovo(Model $model){
        $query = "insert into models (id, data, dimensione, nome, uploader, descrizione)
                  values (?, ?, ?, ?, ?, ?)";
        return $this->modificaDB($model, $query);
    }
    
    public function cancella(Model $model){
        $query = "delete from models where id= ? and data = ? and dimensione = ? and nome = ? and uploader = ? and descrizione = ?";
        return $this->modificaDB($model, $query);
    }
    
    private function modificaDB(Model $model, $query){
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
		if(strlen(strstr($query, 'update')) <=0){ 
			if (!$stmt->bind_param('isisss', 
					$model->getId(),
					$model->getData()->format('Y-m-d'),
					$model->getDimensione(),
					$model->getNome(),
					$model->getUploader(),
					$model->getDescrizione())) {
				error_log("[modificaDB] impossibile" .
						" effettuare il binding in input");
				$mysqli->close();
				return 0;
			}
		}
		else{ 
			if (!$stmt->bind_param('isisiss', 
					$model->getId(),
					$model->getData()->format('Y-m-d'),
					$model->getDimensione(),
					$model->getNome(),
					$model->getUploader(),
					$model->getDescrizione(),
					$model->getId())) {
				error_log("[modificaDB] impossibile" .
						" effettuare il binding in input");
				$mysqli->close();
				return 0;
			}
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
    
    public function &ricercaModelli($uploader, $nome) {echo "( RICERCA MODELLI ) ".$uploader." ".$nome;
        $models_f = array();
        
        // costruisco la where "a pezzi" a seconda di quante 
        // variabili sono definite
        //$bind = "i";
        //$where = " where docenti.id = ? ";
        $where = " where lower(models.uploader) like lower(?) and lower(models.nome) like lower(?) ";
        $par = array();
        //$par[] = $user->getId();
        
        if(isset($uploader) && isset($nome)){echo " (ENTRAMBI) ";
            $where = " where lower(models.uploader) like lower(?) and lower(models.nome) like lower(?) ";
            $bind ="ss";
            //$par[] = $insegnamento;
            $par[] = "%".$uploader."%";
            $par[] = "%".$nome."%";
        }
        
        else
        if(isset($uploader)){echo " (SOLO UPLOADER) ";
            $where = " where lower(models.uploader) like lower(?) ";
            $bind ="s";
            $par[] = "%".$uploader."%";
        }
        
        else
        if(isset($nome)){echo " (SOLO NOME) ";
            $where = " where lower(models.nome) like lower(?) ";
            $bind ="s";
            $par[] = "%".$nome."%";
        }
        
        $query = "select 
                  models.id models_nome,
                  models.data models_data,
				  models.dimensione models_dimensione,
                  models.nome models_nome,
                  models.uploader models_uploader,
				  models.descrizione models_descrizione

                  from models 
                  ".$where;
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {echo " (718 ModelFactory) ";
            error_log("[ricercaEsami] impossibile inizializzare il database");
            $mysqli->close();
            return $models_f;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {echo " (726 ModelFactory) ";
            error_log("[ricercaEsami] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $models_f;
        }

        $models_f = self::caricaModelliDaStmt($stmt);
        $mysqli->close();
        return $models_f;
    }
    
    
}

?>
