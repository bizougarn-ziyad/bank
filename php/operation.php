<?php 
    class operation{
        private $typeTransaction;
        private $Date;
        private $numeroCompte;
        private $montant;
    
        function __construct($typeTransaction, $Date, $numeroCompte, $montant) {
            $this->typeTransaction = $typeTransaction;
            $this->Date = $Date;
            $this->numeroCompte = $numeroCompte;
            $this->montant = $montant;
        }

        public function getTypeTransaction() { return $this->typeTransaction;}
        public function getDate() { return $this->Date;}
        public function getNumeroCompte() { return $this->numeroCompte;}
        public function getMontant() { return $this->montant;}
    }
?>