<?php


try{
	$cn = new PDO("oci:dbname=xe", "IBNROCHD", "azerty");
}
catch (PDOException $erreur)
{
	echo $erreur->getMessage();
}


$rsqt=$cn->prepare("select COUNT(*) from personne ", [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
$rsqt->execute();
//echo $rsqt->fetchColumn().'<br>';
/*while ($zz = $rqt->fetch()){
	echo $zz['IDPERSONNE'];
}*/

/*
echo'<br>';
$count=$rsqt->fetchColumn();
echo 'aze'.$count.'<br><br>';
*/
?>