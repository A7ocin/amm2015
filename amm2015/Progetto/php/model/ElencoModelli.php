<?php

include_once 'Model.php';
/**
 * Classe che rappresenta un elenco di esami da inserire da parte di un Docente
 *
 * @author Davide Spano
 */
class ElencoEsami {

    
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

    /**
     * Aggiunge un modello alla lista
     * @param Model $modello il modello da aggiungere
     * @return boolean true se il modello e' stato aggiunto correttamente,
     * false se era gia' presente in lista e non e' stato aggiunto
     */
    public function aggiungiEsame(Esame $esame) {
        $pos = $this->posizione($esame);
        if($pos > -1){
            // esame gia' inserito
            return false;
        }
        $this->modelli[] = $modello;
        return true;
    }

    
    /**
     * Rimuove un modello dalla lista
     * @param Model $modello l'modello della lista
     * @return boolean true se l'modello e' stato rimosso, false altrimenti (es. 
     * non era in lista)
     */
    public function rimuoviEsame(Esame $modello) {
        $pos = $this->posizione($modello);
        echo var_dump($pos);
        if ($pos > -1) {
            array_splice($this->modelli, $pos, 1);
            return true;
        }

        return false;
    }

    
    /**
     * Restituisce la lista di modelli
     * @return array
     */
    public function &getEsami() {
        return $this->modelli;
    }

    /**
     * Trova la posizione di un modello nella lista
     * @param Model $modello l'modello da trovare
     * @return int la posizione dell'modello se presente, false altrimenti
     */
    private function posizione(Esame $modello) {
        for ($i = 0; $i < count($this->modelli); $i++) {
            if ($this->modelli[$i]->equals($modello)) {
                return $i;
            }
        }
        return -1;
    }

}

?>
