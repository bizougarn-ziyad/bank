<?php
class User {
    private $username;
    private $nom;
    private $prenom;
    private $password;
    private $solde;

    function __construct($username, $nom, $prenom, $password, $solde) {
        $this->username = $username;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->password = $password;
        $this->solde = $solde;
    }

    public function getUsername() { return $this->username; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getPassword() { return $this->password; }
    public function getSolde() { return $this->solde; }
    public function setSolde($solde) { $this->solde = $solde; }
}
?>