<?php
class Database
{
private $hostname="localhost";
private $username="root";
private $password="";
private $dbname;
private $dblink; 
private $result; 
private $records;
private $affected; 
function __construct($dbname)
{
$this->dbname = $dbname;
                $this->Connect();
}

public function getResult()
{
return $this->result;
}
function Connect()
{
$this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
if ($this->dblink ->connect_errno) {
    printf("Konekcija neuspešna: %s\n", $mysqli->connect_error);
    exit();
}
$this->dblink->set_charset("utf8");

}




function select ($table="autor, knjiga, oblast", $rows = '*', $where = "knjigaautorid = autorid && knjigaoblastid = oblastid", $order = null)
{
$q = 'SELECT '.$rows.' FROM '.$table;  
        if($where != null)  
            $q .= ' WHERE '.$where;  
        if($order != null)  
            $q .= ' ORDER BY '.$order; 			
$this->ExecuteQuery($q);
}

function select_naziv ($naziv){
    $table="knjiga";
    $rows = '*';
    $where = "knjiganaziv LIKE '$naziv%'";
    $order = null;
    $q = 'SELECT '.$rows.' FROM '.$table;  
        if($where != null)  
            $q .= ' WHERE '.$where;
        if($order != null)  
            $q .= ' ORDER BY '.$order; 			
$this->ExecuteQuery($q);
}

function select_all_by_naziv($naziv){

    $q="SELECT k.knjiganaziv, k.knjigabrstrana, a.autorime, a.autorprezime, o.oblastnaziv FROM knjiga AS k 
		JOIN autor as a ON k.knjigaautorid = a.autorid
		JOIN oblast as o ON k.knjigaoblastid = o.oblastid WHERE knjiganaziv = '$naziv'";
$this->ExecuteQuery($q);
}

function select_autore ($table="autor", $rows = '*', $where = null, $order = null)
{
$q = 'SELECT '.$rows.' FROM '.$table;  
        if($where != null)  
            $q .= ' WHERE '.$where;  
        if($order != null)  
            $q .= ' ORDER BY '.$order; 			
$this->ExecuteQuery($q);
}
function select_oblast ($table="oblast", $rows = '*', $where = null, $order = null)
{
$q = 'SELECT '.$rows.' FROM '.$table;  
        if($where != null)  
            $q .= ' WHERE '.$where;  
        if($order != null)  
            $q .= ' ORDER BY '.$order; 			
$this->ExecuteQuery($q);
}




function insert ($table="knjiga", $rows = "knjiganaziv, knjigabrstrana, knjigaautorid, knjigaoblastid", $values)
{
$insert = 'INSERT INTO '.$table;  
            if($rows != null)  
            {  
                $insert .= ' ('.$rows.')';   
            }  
			$insert .= ' VALUES(';
			$insert .="'".$values[0]."', '".$values[1]."', '".$values[2]."', '".$values[3]."')";
if ($this->ExecuteQuery($insert))
return true;
else return false;
}



function update ($table="knjiga", $values)
{
$update = 'UPDATE '.$table." SET knjigabrstrana='". $values[1] ."' WHERE knjigaid=". $values[0];		
if (($this->ExecuteQuery($update)))
return true;
else return false;
}



function delete ($table="knjiga", $values)
{
$delete = 'DELETE FROM '.$table.' WHERE knjigaid='.$values[0];
if ($this->ExecuteQuery($delete))
return true;
else return false;
}

function select_knjigaNaziv ($naziv){
    $select = "SELECT knjiganaziv FROM knjiga WHERE knjiganaziv LIKE '$naziv%'";		
    $this->ExecuteQuery($select);
}

function select_user($usr){
    $q="SELECT * FROM korisnik WHERE username LIKE '$usr->username' AND password LIKE '$usr->password'";
    $this->ExecuteQuery($q);
}


function ExecuteQuery($query)
{
if($this->result = $this->dblink->query($query)){

return true;
}
else
{
return false;
}
}

function CleanData()
{

}

}
?>