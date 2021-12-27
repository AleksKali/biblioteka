<?php
class Oblast{
    public $id;   
    public $naziv;   
   
    
    public function __construct($id=null, $naziv=null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
    }
}

?>