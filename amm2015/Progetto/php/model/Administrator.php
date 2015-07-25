<?php

include_once 'User.php';
include_once 'Dipartimento.php';

/**
 * Classe che rappresenta un Docente
 *
 * @author Nicola Garau
 */
class Administrator extends User {

    /**
     * Costruttore
     */
    public function __construct() {
        // richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Administrator);
    }
}

?>
