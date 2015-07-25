<?php

include_once 'User.php';
include_once 'Dipartimento.php';

/**
 * Classe che rappresenta un Docente
 *
 * @author Nicola Garau
 */
class Utente extends User {

    private $eta;

    /**
     * Costruttore
     */
    public function __construct() {
        // richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Utente);
    }
    
    public function getEta() {
        return $this->eta;
    }

    public function setEta($eta) {
        $this->eta = $eta;
        return true;
    }
}

?>
