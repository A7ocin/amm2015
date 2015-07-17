<?php

include_once 'User.php';
include_once 'Dipartimento.php';

/**
 * Classe che rappresenta un Docente
 *
 * @author Nicola Garau
 */
class Artist extends User {

    /**
     * Il Dipartimento di afferenza
     * @var Dipartimento $dipartimento 
     */
    private $dipartimento;
    
    private $eta;
    private $caricamenti;
    private $descrizione_personale;
    /**
     * Descrizione dell'orario di ricevimento
     * @var string
     */
    private $ricevimento;

    /**
     * Costruttore
     */
    public function __construct() {
        // richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Artist);
    }

    /**
     * Restituisce il Dipartimento di afferenza
     * @return Dipartimento
     */
    public function getDipartimento() {
        return $this->dipartimento;
    }

    /**
     * Imposta un nuovo Dipartimento di afferenza
     * @param Dipartimento $dipartimento il nuovo Dipartimento di afferenza
     */
    public function setDipartimento(Dipartimento $dipartimento) {
        $this->dipartimento = $dipartimento;
    }
    
    public function getEta() {
        return $this->eta;
    }

    public function setEta($eta) {
        $this->eta = $eta;
    }
    
    public function getCaricamenti() {
        return $this->caricamenti;
    }

    public function setCaricamenti($caricamenti) {
        $this->caricamenti = $caricamenti;
    }
    
    public function getDescrizionePersonale() {
        return $this->descrizione_personale;
    }

    public function setDescrizionePersonale($descrizione_personale) {
        $this->descrizione_personale = $descrizione_personale;
    }

    /**
     * Imposta un nuovo valore per l'orario di ricevimento
     * @param string $ricevimento il nuovo orario di ricevimento
     * @return boolean true se impostato correttamente, false altrimenti
     */
    public function setRicevimento($ricevimento) {
        $this->ricevimento = $ricevimento;
        return true;
    }

    /**
     * Restituisce la descrizione dell'orario di ricevimento
     * @return string
     */
    public function getRicevimento() {
        return $this->ricevimento;
    }

}

?>
