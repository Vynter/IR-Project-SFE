<?php
session_start();
include('db.php');
if (!isset($_SESSION['id'])){
    header('location: index.php');
    //('Location: Dashboard.php');
}
    //echo $_SESSION['id'];

//require('entete.php');
include_once('header.php');
?>
<!--
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Document</title>

<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
<style type="text/css">
    img{
        margin: 0 auto;
    }
</style>
    </head>
    <body>
     <script>
    /*   $('#nav-tab').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})*/</script> 

-->






<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <br />

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#stat1" class="nav-link active show" role="tab" data-toggle="tab">Statistque sur les notes finales
                des PFE</a>
        </li>

        <li class="nav-item">
            <a href="#stat3" class="nav-link" role="tab" data-toggle="tab">Statistique par Promotion</a>
        </li>

        <li class="nav-item">
            <a href="#stat2" class="nav-link" role="tab" data-toggle="tab">Statistique sur les entreprises </a>
        </li>
        <li class="nav-item">
            <a href="#stat4" class="nav-link" role="tab" data-toggle="tab">Statistique sur les soutenances </a>
        </li>
        <li class="nav-item">
            <a href="#stat5" class="nav-link" role="tab" data-toggle="tab">Statistique sur les commissions de jury</a>
        </li>
    </ul>

    <div class="tab-content" style="padding-top: 50px;margin:0 about;">
        <div role="tabpanel" class="tab-pane fade in active show " id="stat1">
            <div class="col-xs-12  col-md-3 col-lg-4" style="width:33%;margin: 0 auto;">
            <img src="stat/Stat2_Sup16.php">
            </div>
            <hr>
            <div class="col-xs-12  col-md-3 col-lg-4" style="width:33%;margin: 0 auto;">
            <img src="stat/Stat3_Sup10Inf16.php">
            </div>
            <hr>
            <div class="col-xs-12  col-md-3 col-lg-4" style="width:33%;margin: 0 auto;">
            <img src="stat/Stat4_Inférieur10.php">
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="stat2">
            <div class="row">
                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Taux de stagiaire par entreprise</h3>
                    <img src="stat/Stat1.php">
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="stat3">
            <div class="row">
                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Stat6_ajourné2018.php">
                </div>
                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Stat6_admis2018.php">
                </div>
                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Stat6_admis_ajourné2018.php">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Stat7_ajourné2017.php">
                </div>
                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Stat7_admis2017.php">
                </div>
                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Stat7_admis_ajourné2017.php">
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Stat5_admis2019.php">

                </div>
                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Stat5_ajourné2019.php">

                </div>
                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Stat5_admis_ajourné2019.php">
                </div>
            </div>
            <hr>
            <div class="row">

                <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
                    <img src="stat/Strat8_admis_ajournéeALL.php">
                </div>
            </div>

        </div>
        
        <div role="tabpanel" class="tab-pane fade" id="stat4">
            
              <h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Nombre de soutenance par session</h3>
            <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
            <img src="Stat/Stat9_nbrst.php">
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="stat5">
            
              <h3 style="margin-bottom: 30px;margin-top:15px;color:dodgerblue;font-weight:bold;">Nombre d'évaluation effectuées par les commissions jury</h3>
            <div class="col-xs-12  col-md-6 col-lg-4" style="width:80%;margin: 0 auto;">
            <img src="Stat/Stat10_nbrjury.php">
            </div>
            
            
        </div>
        
        
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>

<!--<img src="stat/Stat6_admi2.php">-->
<?php
include_once('footer.php');
        
        ?>