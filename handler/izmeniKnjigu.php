<?php

require "../model/knjiga.php";


if(isset($_POST['id']) && isset($_POST['brstrana'])){
    $knjiga = new Knjiga($_POST['id'], null, $_POST['brstrana'], null, null); 
    $status = Knjiga::update($knjiga);

    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo "Failed";
    }
}else{
        echo "Sva polja su obavezna!";
}
?>