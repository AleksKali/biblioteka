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

<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container-forma-form">
                        <form action="#" method="post" id="dodajForm"> 
                            <h3 style="color: black; text-align: center">Dodaj knjigu</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h3>Naziv:</h3>
                                        <input id="naziv" type="text" style="border: 1px solid black" name="naziv" class="form-txt" />
                                    </div>
                                    <div class="form-group">
                                        <h3>Broj strana:</h3>
                                        <input type="text" style="border: 1px solid black" name="brstrana" class="form-txt" />
                                    </div>
                                    <div class="form-group">
                                    <h3>Autor:</h3>
                                                <select class="search-filed" name="autor">
                                                <option value="">Izaberite autora...</option>
                                                <?php while ($red=$prikaziautore->getResult()->fetch_object()) {  ?>
                                                            <option value="<?php echo $red->autorid; ?>"><?php echo $red->autorime .' '. $red->autorprezime; ?></option>
                                                            <?php  } ?>
                                                </select><br>
                                    </div>
                                    <div><br>
                                        <div class="form-group">
                                        <h3>Oblast:</h3>
                                                <select class="search-filed" name="oblast">
                                                <option value="">Izaberite oblast...</option>
                                                <?php while ($red2=$prikazioblast->getResult()->fetch_object()) {  ?>
                                                            <option value="<?php echo $red2->oblastid; ?>"><?php echo $red2->oblastnaziv;?></option>
                                                            <?php  } ?>
                                                </select><br>
                                        </div><br>
                                    </div><br>
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success btn-block" tyle="background-color: orange; border: 1px solid black;">Dodaj</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


<?php
$izmeniknjigu->select();
?>
    </div>
    <div class="modal fade" id="izmeniModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container-forma-form">
                        <form action="#" method="post" id="izmeniForm">
                            <h1 style="color: black">Izmeni knjigu</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <h3>Knjiga:</h3><br>
					   <select class="search-filed" name="id">
					   <option value="">Izaberite knjigu...</option>
					  
					   <?php while ($red=$izmeniknjigu->getResult()->fetch_object()) {  ?>
					   			<option value="<?php echo $red->knjigaid; ?>"><?php echo $red->knjiganaziv; ?></option>
					   			<?php  } ?>
					   </select><br>
                                    </div>
                                    <div class="form-group"><br>
                                    <h3>Broj strana:</h3><br>
					                    <input name="brstrana" type="text" class="search-filed" placeholder="Unesite novi broj strana..."><br>
                                    </div><br>
                                     <div class="form-group"><br>
                                        <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" style="color: white; background-color: orange; border: 1px solid white"> Izmeni
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer" id="ftr">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                </div>
            </div>



        </div>

    </div>


    <?php
$izbrisiknjigu->select();
?>
    </div>
    <div class="modal fade" id="izbrisiModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container-forma-form">
                        <form action="#" method="post" id="izbrisiForm">
                            <h1 style="color: black">Iznajmi knjigu</h1>
                            <h3 style="color: black">Knjiga:</h3>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <select class="search-filed" name="id">
                                    <option value="">Izaberite knjigu...</option>
                                    
                                    <?php while ($red=$izbrisiknjigu->getResult()->fetch_object()) {  ?>
                                                <option value="<?php echo $red->knjigaid; ?>"><?php echo $red->knjiganaziv; ?></option>
                                                <?php  } ?>
                                    </select><br>
                                    </div><br><br>
                                <div class="form-group"><br>
                                        <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" style="color: white; background-color: orange; border: 1px solid white"> Iznajmi
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                </div><br><br>
                <div class="modal-footer" id="delftr">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                </div>
            </div>
 </div>

    </div>










    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <script src="js/main.js"></script>

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