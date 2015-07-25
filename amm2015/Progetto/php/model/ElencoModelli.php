<?php

include_once 'Model.php';
/**
 * Classe che rappresenta un elenco di esami da inserire da parte di un Docente
 *
 * @author Davide Spano
 */
class ElencoModelli {

    
    /**
     * Un template per la costruzione degli esami da inserire in lista
     * (la lista di esami e' omogenea, cioe' ha la stessa commissione,
     * lo stesso docente, lo stesso insegnamento)
     * @var Model
     */
    private $template;
    
    /**
     * La lista degli esami inseriti
     * @var array
     */
    private $modelli;
    
    /**
     * Costruttore della lista di modelli
     * @var int un identificatore per la lista
     */
    private $id;

    public function __construct($id) {
        $this->id = intval($id);
        $this->template = new Model();
        $this->modelli = array();
    }
    
    /**
     * Restituisce l'esame che fa da matrice (per commissione, docente e 
     * insegnamento) a tutti gli modelli inseriti nella lista
     * @return Model
     */
    public function getTemplate(){
        return $this->template;
    }
    
    /**
     * Restituisce l'indentificatore unico 
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    
}

?>
