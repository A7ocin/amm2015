<?php

include_once 'Studente.php';
include_once 'Insegnamento.php';

/**
 * Rappresenta un modello di esame, che viene pubblicato da un Docente per
 * un Insegnamento. Uno Studente puo' iscriversi ad ad un modello.
 *
 * @author Nicola Garau
 */
class Model {

    /**
     * La data dell'modello
     * @var DateTime 
     */
    private $data;
    
    private $nome;
    
    /**
     * Quanti studenti si possono iscrivere al massimo per questo modello
     * @var int
     */
    private $dimensione;
    
    /**
     * Identificatore dell'modello
     * @var int
     */
    private $id;
	
	private $uploader;
	private $descrizione;
    
    /**
     * Costrutture dell'modello
     */
    public function __construct() {
        $this->iscritti = array();
    }

    /**
     * Restituisce l'indentificatore dell'modello
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Modifica il valore dell'identificatore 
     * @param int $id il nuovo id per l'modello
     * @return boolean true se il valore e' stato modificato, 
     *                 false altrimenti
     */
    public function setId($id) {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->id = $intVal;
        return true;
    }

    /**
     * Restituisce la data dell'modello
     * @return DateTime
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Modifica il valore della data dell'modello
     * @param DateTime $data il nuovo valore della data
     * @return boolean true se il nuovo valore della data e' stato impostato,
     * false nel caso il valore non sia ammissibile
     */
    public function setData(DateTime $data) {
        $this->data = $data;
        return true;
    }

    /**
     * Restituisce il numero massimo di iscritti per l'modello
     * @return int
     */
    public function getDimensione() {
        return $this->dimensione;
    }
    
        /**
     * Modifica il valore massimo per il numero di iscritti all'modello
     * @param int $dimensione la nuova dimensione del corso
     * @return boolean true se il valore e' stato impostato correttamente, false
     * altrimenti (per esempio se ci sono gia' piu' iscritti del valore passato)
     */
    public function setDimensione($dimensione) {
        $intVal = filter_var($dimensione, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        if ($intVal < count($this->iscritti)) {
            return false;
        }
        $this->dimensione = $intVal;
        return true;
    }
    
    /**
     * Restituisce il nome
     * @return int
     */
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
		$this->nome=$nome;
		return true;
	}
	
	public function getUploader() {
        return $this->uploader;
    }
    
    public function setUploader($uploader) {
		$this->uploader=$uploader;
		return true;
	}
	
	public function getDescrizione() {
        return $this->descrizione;
    }
    
    public function setDescrizione($descrizione) {
		$this->descrizione=$descrizione;
		return true;
	}
}

?>
