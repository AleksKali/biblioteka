<?php
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
}

?>