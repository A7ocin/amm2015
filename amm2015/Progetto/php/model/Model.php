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
     * Lista degli iscritti
     * @var array 
     */
    private $iscritti;
    
    /**
     * L'insegnamento oggetto dell'modello
     * @var Insegnamento 
     */
    private $insegnamento;
    
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
     * Iscrive uno studente ad un modello
     * @param Studente $studente lo studente da iscrivere
     * @return boolean true se l'iscrizione e' andata a buon fine, false altrimenti
     */
    public function iscrivi(Studente $studente) {
        if (count($this->iscritti) >= $this->dimensione) {
            return false;
        }
        $this->iscritti[] = $studente;
        return true;
    }

    /**
     * Rimuove l'iscrizione di uno studente dall'modello
     * @param Studente $studente lo studente da cancellare
     * @return boolean true se l'iscrizione e' stata cancellata, false altrimenti
     * es. quando lo studente non era stato iscritto precedentemente
     */
    public function cancella(Studente $studente) {

        $pos = $this->posizione($studente);
        if ($pos > -1) {
            array_splice($this->iscritti, $pos, 1);
            return true;
        }

        return false;
    }

    /**
     * Restituisce la lista di iscritti (per riferimento)
     * @return array
     */
    public function &getIscritti() {
        return $this->iscritti;
    }
    
    /**
     * Restituisce il numero di iscritti
     * @return int
     */
    public function numeroIscritti(){
        return count($this->iscritti);
    }

    /**
     * Restituisce il numero massimo di iscritti per l'modello
     * @return int
     */
    public function getDimensione() {
        return $this->dimensione;
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
     * Restiuisce il numero di posti ancora disponibili per l'modello
     * @return int 
     */
    public function getPostiLiberi() {
        return $this->dimensione - count($this->iscritti);
    }

    /**
     * Verifica se uno studente sia gia' nella lista di iscritti o meno
     * @param Studente $studente lo studente da ricercare
     * @return boolean true se e' gia' in lista, false altrimenti
     */
    public function inLista(Studente $studente) {
        $pos = $this->posizione($studente);
        if ($pos > -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Restituisce l'insegnamento per l'modello
     * @return Insegnamento
     */
    public function getInsegnamento() {
        return $this->insegnamento;
    }

    /**
     * Imposta l'insegnamento per l'modello
     * @param Insegnamento $insegnamento il nuovo insegnamento
     */
    public function setInsegnamento(Insegnamento $insegnamento) {
        $this->insegnamento = $insegnamento;
    }

    /**
     * Calcola la posizione di uno studente all'interno della lista
     * @param Studente $studente lo studente da ricercare
     * @return int la posizione dello studente nella lista, -1 se non e' stato 
     * inserito
     */
    private function posizione(Studente $studente) {
        for ($i = 0; $i < count($this->iscritti); $i++) {
            if ($this->iscritti[$i]->equals($studente)) {
                return $i;
            }
        }
        return -1;
    }

}

?>
