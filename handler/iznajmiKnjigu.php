<?php

require "../model/knjiga.php";


if(isset($_POST['id'])){
    $knjiga = new Knjiga($_POST['id'], null, null, null, null); 
    $status = Knjiga::deleteById($knjiga);

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