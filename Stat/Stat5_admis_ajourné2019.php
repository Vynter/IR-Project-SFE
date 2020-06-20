<?php // content="text/plain; charset=utf-8"

session_start();
include('../db.php');


require_once ('jpgraph-4.2.11/src/jpgraph.php');
require_once ('jpgraph-4.2.11/src/jpgraph_bar.php');


///////////////

$data=array();
$tab2=array();
$décision=array('Admis','Ajourné');


//NBR ING
$rq=$cn->query("select count(*)
from stagiaire s, sujet st, stage sg, pfe pf,soutenance sn, pv p
where s.mat=st.mat and st.idsujet=sg.idsujet and sg.numconv=pf.numconv and pf.codepfe=sn.codepfe and sn.codest = p.codest  AND PROMO='2019' and djury='admis'");
$a1=$rq->fetchColumn();

if ($a1==0){
    $admis=0.05;
}else{
    $admis=$a1;
};
//NBR BTS
$rq2=$cn->query("select count(*)
from stagiaire s, sujet st, stage sg, pfe pf,soutenance sn, pv p
where s.mat=st.mat and st.idsujet=sg.idsujet and sg.numconv=pf.numconv and pf.codepfe=sn.codepfe and sn.codest = p.codest  AND PROMO='2019' and djury='ajourne'");
$a2=$rq2->fetchColumn();

if ($a2==0){
    $ajourné=0.05;
}else{
    $ajourné=$a2;
};







$datay=array($admis,$ajourné);


// Create the graph. These two calls are always required
$graph = new Graph(350,220,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(0,1,2,3,4,5,6,7,8,9,10), array(0.5,1.5,2.5,3.5,4.5,5.5,6.5,7.5,8.5,9.5));
$graph->SetBox(true);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($décision);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);
$graph->title->SetColor('black');
$graph->title->SetFont(FF_ARIAL,FS_BOLD); 

$b1plot->SetColor("white");
$b1plot->SetFillGradient("#264445","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(50);
$graph->title->Set("Stagiaires d'admis et ajournés de la promotion 2019");

// Display the graph
$graph->Stroke();

/////

?>