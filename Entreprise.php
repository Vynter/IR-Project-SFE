<?php
session_start();
include('db.php');
if (!isset($_SESSION['id'])){
    header('location: index.php');
}
include_once('header.php');
?>
<h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Liste des Entreprises</h3>
<table class="table" style="margin-bottom:30px;">
    <thead class="table-primary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Identifiant</th>
            <th scope="col">Raison Social</th>
            <th scope="col">Adresse</th>
            <th scope="col">N°Telephone</th>
            <th scope="col">Adresse Mail</th>
        </tr>
    </thead>
    <tbody>
        <?php 
      
$ENT=$cn->prepare("select * from entreprise
");
$ENT->execute();
$nb=1;
while ($data = $ENT->fetch()){
	
    
    echo '<tr>
            <th scope="row">'.$nb.'</th>
            <td>'.$data['IDENT'].'</td>
            <td>'.$data['RS'].'</td>
            <td>'.$data['ADRESSEENT'].'</td>
            <td>'.$data['NUMTELE'].'</td>
            <td>'.$data['ADRESSEMAILE'].'</td>
        </tr>';
    $nb++;
}
      ?>

    </tbody>
</table>




<?php
include_once('footer.php');


    
?>