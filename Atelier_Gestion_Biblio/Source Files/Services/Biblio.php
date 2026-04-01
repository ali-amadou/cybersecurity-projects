<?php 
include_once "Document.php";

class Biblio {
    private $dao;

    public function __construct(){
        $this->dao = new DAO();
    }

    public function ajouter(Document $doc){
        $data = array(
            "code"=>$doc->getCode(),
            "titre"=>$doc->getTitre()
        );

        if ($doc instanceof Livre){
            $data["auteur"] = $doc->getAuteur();
            $data["nbrepages"] = $doc->getNbrepages();
            $this->dao->setTable("livre");
        } else {
            $data["langue"] = $doc->getLangue();
            $data["nbremots"] = $doc->getNbremots();
            $this->dao->setTable("dictionnaire");
        }

        $this->dao->insert($data);
    }

    public function modifier(Document $doc){
        $data = array(
            "code"=>$doc->getCode(),
            "titre"=>$doc->getTitre()
        );

        if ($doc instanceof Livre){
            $data["auteur"] = $doc->getAuteur();
            $data["nbrepages"] = $doc->getNbrepages();
            $this->dao->setTable("livre");
        } else {
            $data["langue"] = $doc->getLangue();
            $data["nbremots"] = $doc->getNbremots();
            $this->dao->setTable("dictionnaire");
        }

        $this->dao->update($data);
    }

    public function supprimer($code, $type){
        $this->dao->setTable($type);
        return $this->dao->delete($code);
    }

    public function rechercher($code, $type){
        $this->dao->setTable($type);
        return $this->dao->find($code);
    }

    public function lister($type){
        if($type == 'all'){
            $this->dao->setTable("livre");
            $livres = $this->dao->all();

            $this->dao->setTable("dictionnaire");
            $dicos = $this->dao->all();

            return array_merge($livres, $dicos);
        }

        $this->dao->setTable($type);
        return $this->dao->all();
    }

    public function nbre_documents($type){
        if ($type == 'all'){
            $this->dao->setTable("livre");
            $nbrelivres = $this->dao->count();

            $this->dao->setTable("dictionnaire");
            $nbredicos = $this->dao->count();

            return $nbrelivres + $nbredicos;
        }

        $this->dao->setTable($type);
        return $this->dao->count();
    }
}
?>