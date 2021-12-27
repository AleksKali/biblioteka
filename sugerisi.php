<?php

require "baza.php";
$konekcija= new Database("biblioteka");
if (!isset ($_GET["unos"])){
echo "Parametar Unos nije prosleđen!";
} else {
$pomocna=$_GET["unos"];
$konekcija->select_naziv($pomocna);
if ($konekcija->getResult()->num_rows==0){
    echo "U bazi ne postoji knjiga koja počinje na " . $pomocna;
    } else {
while($red = $konekcija->getResult()->fetch_object()){
?>
<a onclick="place(this)"><?php  echo $red->knjiganaziv;?></a>
<br/>
<?php
}
}
}
?>