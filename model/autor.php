<?php
class Autor{
    public $id;   
    public $ime;   
    public $prezime; 
    
    public function __construct($id=null, $ime=null, $prezime=null)
    {
        $this->id = $id;
        $this->ime = $ime;
        $this->prezime = $prezime;
    }

}

?>