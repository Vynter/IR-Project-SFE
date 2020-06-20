<?php // content="text/plain; charset=utf-8"

session_start();
include('../db.php');


require_once ('jpgraph-4.2.11/src/jpgraph.php');
require_once ('jpgraph-4.2.11/src/jpgraph_pie.php');
require_once ('jpgraph-4.2.11/src/jpgraph_pie3d.php');



$data=array();
$tab2=array();
$r1=$cn->query("select count(*)as nbr from notefinal where notefinal>=16");

$a1=$r1->fetchColumn();
//echo $ok;

$r2=$cn->query("select count(*)as nbr from notefinal where notefinal<16");

$a2=$r2->fetchColumn();
    

//echo $data[];



// Some data
$data = array($a2,$a1);
$tab2 =array(' en dessous de 16','Note final Supérieur a 16');
// Create the Pie Graph. 
$graph = new PieGraph(400,400);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$graph->title->SetFont(FF_ARIAL,FS_BOLD); 
// Set A title for the plot
$graph->title->Set("Stagiaire avec une note supérieur ou égale a 16");
$graph->title->SetColor('black');

// Create
$p1 = new PiePlot3D($data);
$p1->SetLegends($tab2);
$graph->legend->Pos(0.05,0.1);
$graph->Add($p1);
$p1->SetSliceColors(array('#2D333A','#2D66AC','green','navy','orange'));
$p1->ShowBorder();

$p1->SetColor('black');
$p1->ExplodeSlice(1);
$graph->Stroke();

?>