<?php
session_start();
include('db.php');
if (!isset($_SESSION['id'])){
    header('location: index.php');
}
include_once('header.php');
?>

<?php
        
    $r=$cn->prepare("select * from personne where IDPERSONNE= :id ");
    $r->execute(array(':id'=>$_SESSION['id']));
                
    while($d=$r->fetch()){
        $fullname=$d['NOM'].' '.$d['PRENOM'] ;
        }
        ?>
<div class="container">
    <div class="row">

        <?php
        
echo '<p style="margin:20px;font-weight:bold;">Bonjour '.$fullname ;       
    ?>

    </div>
    <div class="row">
        <div class="imgcentre">
            <h2 style="color:dodgerblue;font-weight:bold">Gestion des Stages de fin d'études.</h2>
            <img src="img/LOGOEnCouleur.png" style="width:50%">
        </div>
    </div>
</div>


<?php
include_once('footer.php');


    
?>