<?php
require_once '../Model/Manager/UserManager.php';
require_once '../Model/Entity/User.php';
require_once '../Model/Manager/ConnectManager.php';


$connexion = connect_bd();
$titlePage = "Page de connexion";

//var_dump($_POST);

if(!empty($_POST["mail"]) and !empty($_POST["password"])){
    $mail =$_POST["mail"];
    $password =$_POST["password"];
    $result = connect($mail, $password, $connexion);
    //var_dump($result);

    if($result === false){
        $erreur='incorrect';
    }
    else{
        session_start();
        $_SESSION["user"]= $result;
        //var_dump($_SESSION["user"]);
        header("location:listesJeux_Controller.php");
    }
}
/*
$listeusers = getAllUser($connexion);
var_dump($listeusers);*/
require_once '../Vue/formulaireDeConnexionVue.php';

