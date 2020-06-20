<?php
session_start();
session_destroy();
//require('db.php');

/*if ($_SESSION['id']<>''){
$_SESSION['id']='';
*/
    header('Location: index.php');
?>