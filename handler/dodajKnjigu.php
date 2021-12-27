<?php

require "../model/knjiga.php";


if(isset($_POST['naziv']) && isset($_POST['brstrana']) 
&& isset($_POST['autor']) && isset($_POST['oblast'])){
    $knjiga = new Knjiga(null, $_POST["naziv"], $_POST["brstrana"], $_POST["autor"], $_POST["oblast"]); 
    $status = Knjiga::add($knjiga);

    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo "Failed";
    }
    
}
else{
        echo "Sva polja su obavezna!";
}
?>