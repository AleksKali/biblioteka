<?php

require "baza.php";

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$prikazi=new Database("biblioteka");
$prikazi->select();
if (!$prikazi) {
    echo "Nastala je greška pri preuzimanju podataka";
    die(); 
}

if ($prikazi->getResult()->num_rows == 0) {
    echo "Nema podataka za prikaz";
    die(); 
} else {



$prikaziautore=new Database("biblioteka");
$prikazioblast=new Database("biblioteka");
$izmeniknjigu=new Database("biblioteka");
$izbrisiknjigu=new Database("biblioteka");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Biblioteka FON</title>
    

</head>

<body>


    <div class="jumbotron" style="color: black;">
        <h1>Biblioteka</h1>
        <p style="color: white">Dobrodošli na zvaničnu stranicu biblioteke FON-a!</p>
    </div>

    <div class="row" style="background-color: rgba(225, 225, 208, 0.5);">
        <div class="col-md-4">
            <button id="btn-dodaj" type="button" class="btn btn-success btn-block" style="background-color: rgb(10, 78, 78); border: 1px solid white;" data-toggle="modal" data-target="#myModal">Dodaj knjigu</button>
        </div>
        <div class="col-md-4">
            <button id="btn-izmeniK" type="button" class="btn btn-success btn-block" style="background-color: rgb(10, 78, 78); border: 1px solid white;" data-toggle="modal" data-target="#izbrisiModal">Iznajmi knjigu</button>
        </div>
        <div class="col-md-4">
            <button id="btn-izmeniK" type="button" class="btn btn-success btn-block" style="background-color: rgb(10, 78, 78); border: 1px solid white;" data-toggle="modal" data-target="#izmeniModal">Izmeni knjigu</button>
        </div>
    </div>

    <div id="pregled" class="panel panel-success" style="margin-top: 1%;">

        <div class="panel-body">
            <h1>Trenutno u biblioteci:</h1>
            <table id="myTable" class="table table-hover table-striped" style="color: black; background-color: white;">
                <thead class="thead">
                    <tr>
                        <th scope="col">Naziv</th>
                        <th scope="col">Broj strana</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Oblast</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($red=$prikazi->getResult()->fetch_object()) {  ?>
						<tr>
							<td><?php echo $red->knjiganaziv; ?></td>
							<td><?php echo $red->knjigabrstrana; ?></td>
							<td><?php echo $red->autorime .' '. $red->autorprezime ?></td>
							<td><?php echo $red->oblastnaziv; ?></td>
						</tr>
                        <?php  } ?>
                </tbody>
            </table>
            <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                    <button id="btn-sortiraj" class="btn btn-normal" onclick="sortTable()">Sortiraj</button>
                </div>

            </div>
    
            </div>
    <?php
}
$prikaziautore->select_autore();
$prikazioblast->select_oblast();
?>
   <script>
        function sortTable() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("myTable");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[3];
                    y = rows[i + 1].getElementsByTagName("TD")[3];
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

    </script>


</body>

</html>