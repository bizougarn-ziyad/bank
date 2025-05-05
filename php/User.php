<?php
class User {
    private $username;
    private $nom;
    private $prenom;
    private $password;
    private $solde;
    private $profile_picture;
    private $account_number;

    function __construct($username, $nom, $prenom, $password, $solde, $profile_picture, $account_number) {
        $this->username = $username;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->password = $password;
        $this->solde = $solde;
        $this->profile_picture=$profile_picture;
        $this->account_number=$account_number;
    }

    public function getUsername() { return $this->username; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getPassword() { return $this->password; }
    public function getSolde() { return $this->solde; }
    public function getProfilePicture() { return $this->profile_picture; }
    public function getAccountNumber() { return $this->account_number; }
    public function setSolde($solde) { $this->solde = $solde; }
}
?>