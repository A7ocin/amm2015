<?php

include_once 'Studente.php';
include_once 'Insegnamento.php';

/**
 * Model class
 *
 * @author Nicola Garau
 */
class Model {

    private $data;
    
    private $nome;
    
    private $dimensione;
    
    private $id;
	
	private $uploader;
	
	private $descrizione;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->iscritti = array();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->id = $intVal;
        return true;
    }

    public function getData() {
        return $this->data;
    }

    public function setData(DateTime $data) {
        $this->data = $data;
        return true;
    }

    public function getDimensione() {
        return $this->dimensione;
    }
    
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
