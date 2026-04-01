<?php 
class Livre extends Document {
    private $auteur, $nbrepages;

    public function __construct($c, $t, $a, $n){
        parent::__construct($c, $t);
        $this->auteur = $a;
        $this->nbrepages = $n;
    }

    public function getAuteur(){
        return $this->auteur;
    }

    public function setAuteur($auteur){
        $this->auteur = $auteur;
    }

    public function getNbrepages(){
        return $this->nbrepages;
    }

    public function setNbrepages($nbrepages){
        $this->nbrepages = $nbrepages;
    }
}
?>