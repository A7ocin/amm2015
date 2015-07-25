<?php

include_once 'Model.php';
/**
 * ElencoModelli class
 *
 * @author Nicola Garau
 */
class ElencoModelli {

    private $template;
    
    private $modelli;
    
    private $id;

    public function __construct($id) {
        $this->id = intval($id);
        $this->template = new Model();
        $this->modelli = array();
    }
    
    public function getTemplate(){
        return $this->template;
    }
    
    public function getId(){
        return $this->id;
    }

    
}

?>
