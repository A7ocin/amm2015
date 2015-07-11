<?php

include_once 'Dipartimento.php';
include_once 'Db.php';

/**
 * Classe per creare oggetti di tipo Dipartimento
 *
 * @author Davide Spano
 */
class DipartimentoFactory {
    
    private static $singleton;
    
    private function __constructor(){
    }
    
    
    /**
     * Restiuisce un singleton per creare Dipartimenti
     * @return \DipartimentoFactory
     */
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new DipartimentoFactory();
        }
        
        return self::$singleton;
    }
    
    /**
     * Restituisce la lista di tutti i Dipartimenti
     * @return array|\Dipartimento
     */
    public function &getDipartimenti(){
        
        $dip = array();
        $query = "select * from dipartimenti";
        $mysqli = Db::getInstance()->connectDb();
        if(!isset($mysqli)){
            error_log("[getDipartimenti] impossibile inizializzare il database");
            $mysqli->close();
            return $dip;
        }
        $result = $mysqli->query($query);
        if($mysqli->errno > 0){
            error_log("[getDipartimenti] impossibile eseguire la query");
            $mysqli->close();
            return $dip;
        }
        
        while($row = $result->fetch_array()){
            $dip[] = self::getDipartimento($row);
        }
        
        $mysqli->close();
        return $dip;
    }
    
    /**
     * Crea un dipartimento da una riga di DB
     * @param type $row
     */
    public function creaDaArray($row){
        $dip = new Dipartimento();
        $dip->setId($row['dipartimenti_id']);
        $dip->setNome($row['dipartimenti_nome']);
        return $dip;
    }
    
    /**
     * Crea un oggetto di tipo Dipartimento a partire da una riga del DB
     * @param type $row
     * @return \Dipartimento
     */
    private function getDipartimento($row){
        $dipartimento = new Dipartimento();
        $dipartimento->setId($row['id']);
        $dipartimento->setNome($row['nome']);
        return $dipartimento;
    }
    
   
}

?>
