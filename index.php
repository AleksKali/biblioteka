<?php

require "model/korisnik.php";

session_start();
if(isset($_POST['userName']) && isset($_POST['password'])){
    $uname = $_POST['userName'];
    $upass = $_POST['password'];


    $korisnik = new Korisnik(1, $uname, $upass);
   
    $logIn= new Database("biblioteka");
    $logIn->select_user($korisnik);

    if($logIn->getResult()->num_rows == 1){
        echo  "Uspesna prijava!";
        $_SESSION['user_id'] = $korisnik->id;
        header('Location: home.php');
        exit();
    }else{
        echo "Niste se prijavili.";
    }

}

?>


<!DOCTYPE html>
<html lang="en"  style="background-image: url('img/slika.jpg');">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>Biblioteka: prijava</title>

</head>
<body  style="background-image: url('img/slika2.jpg');">
<div class="wrapper">
    <div class="text-center mt-4 name"> Biblioteka </div>
    <form method="POST" action="#" class="p-3 mt-3"><br><br>
        <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="text" name="userName" id="userName" placeholder="Username"> </div><br>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="password" id="pwd" placeholder="Password"></div> <br><br>
        <button class="btn mt-3">Login</button>
    </form>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>