<?php 
	require "baza.php";
    

    $pretrazi=new Database("biblioteka");

	if (empty($_GET['naziv'])){
		echo '<div class="title"><h1>Unesite naziv knjige!</h1</div>';
	} else {
		$naziv = $_GET['naziv'];
        $pretrazi->select_all_by_naziv($naziv);

			?>


<div class="panel-body">
<div id="tabela" class="table table-hover table-striped" style="color: black; background-color: grey;">
                <table >
                <thead class="thead">
                    <tr>
                        <th scope="col">
                            Naziv
                            </th>
                        <th scope="col">
                            Broj strana
                            </th>
                        <th scope="col">
                            Autor
                            </th>
						<th scope="col">
                            Oblast
                            </th>
                    </tr>
                    </thead>
                <tbody>
                   
                        <?php while($red=$pretrazi->getResult()->fetch_object()){   ?>
						<tr>
							<td><?php echo $red->knjiganaziv; ?></td>
							<td><?php echo $red->knjigabrstrana; ?></td>
							<td><?php echo $red->autorime .' '. $red->autorprezime ?></td>
							<td><?php echo $red->oblastnaziv; ?></td>
						</tr>
                        <?php } ?>
	             </tbody>
                </table>
            </div>          <?php } ?>
            </div> 