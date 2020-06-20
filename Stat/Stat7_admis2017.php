<?php // content="text/plain; charset=utf-8"

session_start();
include('../db.php');


require_once ('jpgraph-4.2.11/src/jpgraph.php');
require_once ('jpgraph-4.2.11/src/jpgraph_bar.php');


///////////////

$data=array();
$tab2=array();
$cycle=array();
$c=$cn->query('select codecycle from cyclee');

while ($cd = $c->fetch()){
  $cycle[]=$cd['CODECYCLE'];
};


//NBR ING
$rq=$cn->query("select count(*) as ID
from stagiaire s, sujet st, stage sg, pfe pf,soutenance sn, pv p
where s.mat=st.mat and st.idsujet=sg.idsujet and sg.numconv=pf.numconv and pf.codepfe=sn.codepfe and sn.codest = p.codest and codecycle='ING' AND PROMO='2017' and djury='admis'
");
$a1=$rq->fetchColumn();

if ($a1==0){
    $ing=0.05;
}else{
    $ing=$a1;
};
//NBR BTS
$rq2=$cn->query("select count(*)
from stagiaire s, sujet st, stage sg, pfe pf,soutenance sn, pv p
where s.mat=st.mat and st.idsujet=sg.idsujet and sg.numconv=pf.numconv and pf.codepfe=sn.codepfe and sn.codest = p.codest  AND PROMO='2017' and djury='admis' and codecycle='BTS'
");
$a2=$rq2->fetchColumn();

if ($a2==0){
    $bts=0.05;
}else{
    $bts=$a2;
};
//nbr master
$rq3=$cn->query("select count(*)
from stagiaire s, sujet st, stage sg, pfe pf,soutenance sn, pv p
where s.mat=st.mat and st.idsujet=sg.idsujet and sg.numconv=pf.numconv and pf.codepfe=sn.codepfe and sn.codest = p.codest  AND PROMO='2017' and djury='admis' and codecycle='MSP'
");
$a3=$rq3->fetchColumn();

if ($a3==0){
    $msp=0.05;
}else{
    $msp=$a3;
};






$datay=array($bts,$ing,$msp);


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
$graph->xaxis->SetTickLabels($cycle);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillGradient("#2D3750","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(55);
$graph->title->Set("Stagiaires d'admis pour la promotion 2017");
$graph->title->SetColor('black');
$graph->title->SetFont(FF_ARIAL,FS_BOLD); 
// Display the graph
$graph->Stroke();

/////

?>