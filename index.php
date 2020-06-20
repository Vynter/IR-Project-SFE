<?php
session_start();
include('db.php');
//session_destroy();
//session_start();


/*if (!empty($_SESSION['id'])){
echo $_SESSION['id'];};*/
if (!empty($_POST)){
    extract($_POST);
    $co=true;
    
    $id = htmlspecialchars(trim($id));
    $mdp = htmlspecialchars(trim($mdp));
    
    if (empty($id)){
        
        $co=false;
    }
    if (empty($mdp)){
        
        $co=false;
    }
    $rqt=$cn->prepare("select count(*) from personne where IDPERSONNE= :id and mdp= :mdp");
    $rqt->execute(array(':id'=>$id ,':mdp'=>$mdp));
    $ok=$rqt->fetchColumn(); 
    
    if($ok==0){
        $erreur="Mot de passe ou identifiant irroné.";
        $co=false;
    }
    if(($ok<>0) && ($co)){
        //session_unset();
        $_SESSION['id']=$id;
        
        header('Location: Accueil.php');
    }
    
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>IBNROCHD - Autentification</title>

    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/style1.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 "></div>
            <div class="col-md-4" id="centre">
                <img src="img/logo.png">
                <!--                    <h1 class="text-center">Log</h1>-->
                <form action="" method="POST">
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" class="form-control" name="id" placeholder="Identifiant"
                            value="<?php if(isset($id)){echo $id;} ?>">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" name="mdp" placeholder="Password">
                    </div>




                    <br>

                    <input type="submit" name="a" value="Connexion" class="btn btn-primary">


                    <!--                    <a href="#"><div class="btn btn-primary">Connection</div></a>-->
                </form>

                <div> <?php 
                    if(isset($erreur)){echo '<p>'.$erreur.'</p>';}else{ echo '<p> </p> ';} ?></div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>












</body>

</html>