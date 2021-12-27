<?php
require "../baza.php";
class Knjiga{
    public $id;   
    public $naziv;   
    public $brstrana; 
    public $autor;
    public $oblast;
    
    public function __construct($id=null, $naziv=null, $brstrana=null, $autor=null, $oblast=null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->brstrana = $brstrana;
        $this->autor = $autor;
        $this->oblast = $oblast;
    }


    public static function deleteById($knjiga)
    {
        $dodaj=new Database("biblioteka");
        $podaci=array($knjiga->id);
        return $dodaj->delete("knjiga", $podaci);
    }

    public static function update($knjiga)
    {
        $dodaj=new Database("biblioteka");
        $podaci=array($knjiga->id, $knjiga->brstrana);
        return $dodaj->update("knjiga", $podaci);
    }

    
    public static function add($knjiga)
    {
        $dodaj=new Database("biblioteka");
        $podaci=array($knjiga->naziv, $knjiga->brstrana, $knjiga->autor, $knjiga->oblast);
        return $dodaj->insert("knjiga", "knjiganaziv, knjigabrstrana, knjigaautorid, knjigaoblastid", $podaci);
    }
}

?>