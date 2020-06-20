<?php
session_start();
include('db.php');
if (!isset($_SESSION['id'])){
    header('location: index.php');
}
include_once('header.php');
?>
<h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Liste des Stagiaires de chaque Cycle
    de chaque Promotion</h3>
<table class="table" style="margin-bottom:30px;">
    <thead class="table-primary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Matricule</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Cycle</th>
            <th scope="col">Promotion</th>
        </tr>
    </thead>
    <tbody>
        <?php 
      
$sta=$cn->prepare("select s.mat,prenom,nom,intcycle,promo from personne p, stagiaire s , cyclee c
where p.idpersonne=s.idpersonne and c.codecycle=s.codecycle
order by promo desc, c.intcycle 
");
$sta->execute();
$nb=1;
while ($data = $sta->fetch()){
	
    
    echo '<tr>
            <th scope="row">'.$nb.'</th>
            <td>'.$data['MAT'].'</td>
            <td>'.$data['PRENOM'].'</td>
            <td>'.$data['NOM'].'</td>
            <td>'.$data['INTCYCLE'].'</td>
            <td>'.$data['PROMO'].'</td>
        </tr>';
    $nb++;
}
      ?>

    </tbody>
</table>




<?php
include_once('footer.php');


    
?>