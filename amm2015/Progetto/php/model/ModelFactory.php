<?php

include_once 'Model.php';
include_once 'UserFactory.php';
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
        
        if(count($models > 0)){
            $mysqli->close();
            return $models[0];
        }else{
            $mysqli->close();
            return null;
        }
    }
       
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

        $models =  self::caricaModelliDaStmt($stmt);
        
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

        $models =  self::caricaModelliDaStmt($stmt);
        
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

        $models =  self::caricaModelliDaStmt($stmt);
        
        $mysqli->close();
        return $models;
    }
    
    private function &caricaModelliDaStmt(mysqli_stmt $stmt){
        $models = array();
         if (!$stmt->execute()) {
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
    }

    public function creaDaArray($row){
        $model = new Model();
        $model->setId($row['models_id']);
        $model->setDimensione($row['models_dimensione']);
        $model->setNome($row['models_nome']);
        $model->setData(new DateTime($row['models_data']));
        $model->setUploader($row['models_uploader']);
        $model->setDescrizione($row['models_descrizione']);
        return $model;
    }
    
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
		
		$mysqli->autocommit(false);

        if (!$stmt->execute()) {
            error_log("[modificaDB] impossibile" .
                    " eseguire lo statement");
            $mysqli->rollback();
            $mysqli->close();
            return 0;
        }
		
		$mysqli->commit();
        $mysqli->autocommit(true);
        $mysqli->close();
        return $stmt->affected_rows;
    }
    
    public function &ricercaModelli($uploader, $nome) {
        $models_f = array();
        
        $where = " where lower(models.uploader) like lower(?) and lower(models.nome) like lower(?) ";
        $par = array();
        
        if(isset($uploader) && isset($nome)){
            $where = " where lower(models.uploader) like lower(?) and lower(models.nome) like lower(?) ";
            $bind ="ss";
            $par[] = "%".$uploader."%";
            $par[] = "%".$nome."%";
        }
        
        else
        if(isset($uploader)){
            $where = " where lower(models.uploader) like lower(?) ";
            $bind ="s";
            $par[] = "%".$uploader."%";
        }
        
        else
        if(isset($nome)){
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
        if (!isset($mysqli)) {
            error_log("[ricercaEsami] impossibile inizializzare il database");
            $mysqli->close();
            return $models_f;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[ricercaEsami] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $models_f;
        }
        
        switch (count($par)) {
            case 1:
                if (!$stmt->bind_param($bind, $par[0])) {
                    error_log("[ricercaModelli] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $models_f;
                }
                break;
            case 2:
                if (!$stmt->bind_param($bind, $par[0], $par[1])) {
                    error_log("[ricercaModelli] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $models_f;
                }
                break;
        }

        $models_f = self::caricaModelliDaStmt($stmt);
        $mysqli->close();
        return $models_f;
    }
    
    
}

?>
