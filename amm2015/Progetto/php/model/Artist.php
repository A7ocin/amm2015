<?php

include_once 'User.php';
include_once 'Dipartimento.php';

/**
 * Artist class
 *
 * @author Nicola Garau
 */
class Artist extends User {
    
    private $eta;
    private $caricamenti;
    private $descrizione_personale;

    /**
     * Constructor
     */
    public function __construct() {
        // superclass constructor call
        parent::__construct();
        $this->setRuolo(User::Artist);
    }
    
    public function getEta() {
        return $this->eta;
    }

    public function setEta($eta) {
        $this->eta = $eta;
        return true;
    }
    
    public function getCaricamenti() {
        return $this->caricamenti;
    }

    public function setCaricamenti($caricamenti) {
        $this->caricamenti = $caricamenti;
        return true;
    }
    
    public function getDescrizionePersonale() {
        return $this->descrizione_personale;
    }

    public function setDescrizionePersonale($descrizione_personale) {
        $this->descrizione_personale = $descrizione_personale;
        return true;
    }
}

?>
