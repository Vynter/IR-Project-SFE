<?php
session_start();
include('../db.php');
require_once ('jpgraph-4.2.11/src/jpgraph.php');
require_once ('jpgraph-4.2.11/src/jpgraph_pie.php');
/*<?php
session_start();
if (!isset($_SESSION['id'])){
    header('location: index.php');
    //('Location: Dashboard.php');
}
    //echo $_SESSION['id'];

*/

$data=array();
$tab2=array();
$zz=$cn->query("select count(*) as NB,djury
from stagiaire s, sujet st, stage sg, pfe pf,soutenance sn, pv p
where s.mat=st.mat and st.idsujet=sg.idsujet and sg.numconv=pf.numconv and pf.codepfe=sn.codepfe and sn.codest = p.codest 
group by djury");

while ($info= $zz->fetch()){
    $data[]=$info['DJURY'];
    $tab2[]=$info['NB'];
    
}



$graph = new PieGraph(400,400);
$graph->SetShadow();
 
// Set A title for the plot
$graph->title->Set("Nombre de Stagiaire par entreprises");
$graph->title->SetColor('black');
$graph->title->SetFont(FF_ARIAL,FS_BOLD); 
 
// Create plots
$size=0.20;
$p1 = new PiePlot($data);
$p1->SetLegends($tab2);
$p1->SetSize($size);
$p1->SetCenter(0.25,0.32);
$p1->SetColor('gray');
$p1->SetSliceColors(array('darkgray','darkblue'));
//$p1->value->SetFont(FF_FONT0,FS_BOLD,10);
//$p1->title->Set("Nombre de Stagiaire par entreprise");
 

$graph->Add($p1);

 
$graph->Stroke();
?>