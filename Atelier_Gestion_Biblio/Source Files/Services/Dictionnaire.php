<?php 
class Dictionnaire extends Document {
    private $langue, $nbremots;

    public function __construct($c, $t, $l, $n){
        parent::__construct($c, $t);
        $this->langue = $l;
        $this->nbremots = $n;
    }

    public function getLangue(){
        return $this->langue;
    }

    public function setLangue($langue){
        $this->langue = $langue;
    }

    public function getNbremots(){
        return $this->nbremots;
    }

    public function setNbremots($nbremots){
        $this->nbremots = $nbremots;
    }
}
?>