<?php

/**
 * User class
 */
class User {
    
    const Administrator = 3;
    const Artist = 4;
    const Utente = 5;
    
    
    private $username;
    private $password;
    private $nome;
    private $cognome;
    private $email;
    private $ruolo;
    private $via;
    private $numeroCivico;
    private $citta;
    private $provincia;
    private $cap;
    private $id;

    /**
     * Constructor
     */
    public function __construct() {
        
    }

    public function esiste() {
        return isset($this->ruolo);
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        if (!filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[a-zA-Z]{4,}/')))) {
            return false;
        }
        $this->username = $username;
        return true;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return true;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }

    public function getCognome() {
        return $this->cognome;
    }

    public function setCognome($cognome) {
        $this->cognome = $cognome;
        return true;
    }

    public function getRuolo() {
        return $this->ruolo;
    }

    public function setRuolo($ruolo) {
        switch ($ruolo) {
            case self::Administrator:
            case self::Artist:
            case self::Utente:
                $this->ruolo = $ruolo;
                return true;
            default:
                return false;
        }
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $this->email = $email;
        return true;
    }

    public function getVia() {
        return $this->via;
    }

    public function setVia($via) {
        $this->via = $via;
        return true;
    }

    public function getNumeroCivico() {
        return $this->numeroCivico;
    }

    public function setNumeroCivico($civico) {
        $intVal = filter_var($civico, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            $this->numeroCivico = $intVal;
            return true;
        }
        return false;
    }

    public function setCitta($citta) {
        $this->citta = $citta;
        return true;
    }

    public function getCitta() {
        return $this->citta;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
        return true;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function getCap() {
        return $this->cap;
    }

    public function setCap($cap) {
        if (!filter_var($cap, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[0-9]{5}/')))) {
            return false;
        }
        $this->cap = $cap;
        return true;
    }

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal)){
            return false;
        }
        $this->id = $intVal;
    }
    
    public function equals(User $user) {

        return  $this->id == $user->id &&
                $this->nome == $user->nome &&
                $this->cognome == $user->cognome &&
                $this->ruolo == $user->ruolo;
    }

}

?>
