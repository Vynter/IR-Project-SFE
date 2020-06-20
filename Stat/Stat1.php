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
$zz=$cn->query("select e.ident,e.RS,a.nbrStagiaire from
(
select e.ident,count(*) as nbrStagiaire
from entreprise e, sujet s,stage st
where e.ident=s.ident and s.idsujet=st.idsujet
group by e.ident
order by nbrStagiaire desc) a, entreprise e 
where e.ident=a.ident ");

while ($S = $zz->fetch()){
    $data[]=$S['NBRSTAGIAIRE'];
    $tab2[]=$S['RS'];
}



$graph = new PieGraph(600,600);
$graph->SetShadow();
 
// Set A title for the plot

$graph->title->SetColor('black');
$graph->title->SetFont(FF_ARIAL,FS_BOLD); 
 
// Create plots
$size=0.20;
$p1 = new PiePlot($data);
$p1->SetLegends($tab2);
$p1->SetSize($size);
$p1->SetCenter(0.25,0.32);
$p1->SetColor('gray');
$p1->SetSliceColors(array('darkgray','darkblue','green','navy','orange'));
//$p1->value->SetFont(FF_FONT0,FS_BOLD,10);
//$p1->title->Set("Nombre de Stagiaire par entreprise");
 

$graph->Add($p1);

 
$graph->Stroke();
?>