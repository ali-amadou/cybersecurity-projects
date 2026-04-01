<?php 
class DAO extends PDO {
    private $table;

    public function __construct(){
        $env = file('.env');

        foreach($env as $line){
            list($key,$value) = explode('=', trim($line));
            $_ENV[$key] = $value;
        }

        $dsn = "mysql:host=".$_ENV["DB_HOST"].";dbname=".$_ENV["DB_DATABASE"];
        $user = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];

        parent::__construct($dsn, $user, $password);
    }

    public function setTable($table){
        $this->table = $table;
    }

    public function insert($data){
        $req = "INSERT INTO ".$this->table." (";
        $keys = $values = "";

        foreach($data as $key=>$value){
            $keys .= $key.',';
            $values .= "'".$value."',";
        }

        $keys = substr($keys,0,-1);
        $values = substr($values,0,-1);

        $req .= $keys.') VALUES ('.$values.')';

        return parent::exec($req);
    }

    public function update($data){
        $id = $data["code"];
        unset($data["code"]);

        $set = "";
        foreach($data as $key=>$value){
            $set .= "$key='$value',";
        }

        $set = substr($set,0,-1);

        $req = "UPDATE ".$this->table." SET $set WHERE code='$id'";
        return parent::exec($req);
    }

    public function delete($id){
        $req = "DELETE FROM ".$this->table." WHERE code='$id'";
        return parent::exec($req);
    }

    public function find($id){
        $req = "SELECT * FROM ".$this->table." WHERE code='$id'";
        $res = parent::query($req);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function all(){
        $req = "SELECT * FROM ".$this->table;
        $res = parent::query($req);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count(){
        $req = "SELECT COUNT(*) as total FROM ".$this->table;
        $res = parent::query($req);
        return $res->fetch(PDO::FETCH_ASSOC)["total"];
    }
}
?>