<?php

include_once 'Dipartimento.php';
include_once 'CorsoDiLaurea.php';

/**
 * Classe per creare oggetti di tipo CorsoDiLaurea
 *
 * @author Davide Spano
 */
class CorsoDiLaureaFactory {
    
    private static $singleton;
    
    private function __constructor(){
    }
    
    
    /**
     * Restiuisce un singleton per creare CdL
     * @return \CorsoDiLaureaFactory
     */
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new CorsoDiLaureaFactory();
        }
        
        return self::$singleton;
    }

    /**
     * Restiuisce la lista di CorsiDiLaurea per un Dipartimento
     * @param Dipartimento $dip il Dipartimento in questione
     * @return array|\CorsoDiLaurea
     */
    public function &getCorsiDiLaureaPerDipartimento(Dipartimento $dip) {

        if (!isset($dip)) {
            return array();
        }
        
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCorsiDiLaureaPerDipartimento] impossibile inizializzare il database");
            $mysqli->close();
            return array();
        }

        $query = "select id, codice, nome from CdL where dipartimento_id = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getCorsiDiLaureaPerDipartimento] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return array();
        }

        if (!$stmt->bind_param('i', $dip->getId())) {
            error_log("[getCorsiDiLaureaPerDipartimento] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return array();
        }
        
        $corsi =  self::inizializzaListaCorsi($stmt);
        foreach ($corsi as $corso){
            $corso->setDipartimento($dip);
        }
        $mysqli->close();
        return $corsi;
    }

    /**
     * Restituisce tutti i CorsiDiLaurea esistenti
     * @return array|\CorsoDiLaurea
     */
    public function &getCorsiDiLaurea() {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCorsiDiLaurea] impossibile inizializzare il database");
            return array();
        }

        $query = "select id, codice, nome from CdL";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getCorsiDiLaurea] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return array();
        } 
        
        $toRet =  self::inizializzaListaCorsi($stmt);
        $mysqli->close();
        return $toRet;
    }

    /**
     * Popola una lista di corsi di laurea con una query variabile
     * Attenzione: non popola il collegamento ai Dipartimenti
     * @param mysqli_stmt $stmt
     * @return array|\CorsoDiLaurea
     */
    private function &inizializzaListaCorsi(mysqli_stmt $stmt) {
        $corsi = array();

        if (!$stmt->execute()) {
            error_log("[inizializzaListaCorsi] impossibile" .
                    " eseguire lo statement");
            return $corsi;
        }

        $id = 0;
        $nome = "";
        $codice = "";
        if (!$stmt->bind_result($id, $codice, $nome)) {
            error_log("[inizializzaListaCorsi] impossibile" .
                    " effettuare il binding in output");
            return array();
        }
        while ($stmt->fetch()) {
            $corso = new CorsoDiLaurea();
            $corso->setCodice($codice);
            $corso->setNome($nome);
            $corso->setId($id);
            $corsi[] = $corso;
        }
        return $corsi;
    }
    
    public function creaDaArray($row){
        $cdl = new CorsoDiLaurea();
        $cdl->setId($row['CdL_id']);
        $cdl->setCodice($row['CdL_codice']);
        $cdl->setNome($row['CdL_nome']);
        $cdl->setDipartimento(DipartimentoFactory::instance()->creaDaArray($row));
        return $cdl;
    }

}

?>
