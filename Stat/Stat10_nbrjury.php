<?php // content="text/plain; charset=utf-8"

session_start();
include('../db.php');


require_once ('jpgraph-4.2.11/src/jpgraph.php');
require_once ('jpgraph-4.2.11/src/jpgraph_bar.php');


///////////////
$data=array();
$tab2=array();
$cycle=array();

$r1=$cn->query("select  codej,count(*) as nbr from soutenance  group by codej order by codej");

while ($dd=$r1->fetch()){
    $cycle[]=$dd['CODEJ'];
    $data[]=$dd['NBR'];
    
    
}








$datay=$data;


// Create the graph. These two calls are always required
$graph = new Graph(550,320,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14), array(0.5,1.5,2.5,3.5,4.5,5.5,6.5,7.5,8.5,9.5,10.5,11.5,12.5,13.5));
$graph->SetBox(true);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($cycle);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillGradient("#365ABD","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(50);

$graph->title->SetColor('black');
$graph->title->SetFont(FF_ARIAL,FS_BOLD); 
// Display the graph
$graph->Stroke();

/////

?>