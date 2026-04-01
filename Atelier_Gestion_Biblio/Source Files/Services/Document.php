<?php 
abstract class Document {
    protected $code, $titre;

    public function __construct($c, $t){
        $this->code = $c;
        $this->titre = $t;
    }

    public function getCode(){
        return $this->code;
    }

    public function setCode($code){
        $this->code = $code;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function setTitre($titre){
        $this->titre = $titre;
    }
}
?>