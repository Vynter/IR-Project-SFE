<?php // content="text/plain; charset=utf-8"

session_start();
include('../db.php');


require_once ('jpgraph-4.2.11/src/jpgraph.php');
require_once ('jpgraph-4.2.11/src/jpgraph_pie.php');
require_once ('jpgraph-4.2.11/src/jpgraph_pie3d.php');



$data=array();
$tab2=array();
$r1=$cn->query("select * from NBRSOUTENANCE
");

while ($dd=$r1->fetch()){
    
    $data[]=$dd['NBR'];
    $tab2[]=$dd['CODESESSION'];
    
    
}






// Create the Pie Graph. 
$graph = new PieGraph(500,500);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$graph->title->SetFont(FF_ARIAL,FS_BOLD); 
// Set A title for the plot
/*$graph->title->Set("Nombre de soutenance par session");*/
$graph->title->SetColor('black');

// Create
$p1 = new PiePlot3D($data);
$p1->SetLegends($tab2);
$graph->legend->Pos(0.05,0.1);
$graph->Add($p1);
$p1->SetSliceColors(array('#FF8A40','#F6E7CE','#A46480','#3A8590','#C1A7E2','#2D66AC','red','darkblue','darkred','black'));
$p1->ShowBorder();

$p1->SetColor('black');
$p1->ExplodeSlice(1);
$graph->Stroke();

?>