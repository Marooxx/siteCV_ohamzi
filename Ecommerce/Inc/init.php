<?php
//---- On se connecte à la bas pour commencer
$mysqli = new mysqli('localhost','root','','ecommerce');
// on écrit une condition en cas d'erreur
if($mysqli->connect_error)die("un problème est survenu lors de la connexion à la BDD: ".$mysqli->connect_error);

//----------Ouverture de session
session_start();// on démarre la session
//----------- Chemin
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/github/PHP/Ecommerce/");
define("URL","http://localhost/github/PHP/Ecommerce/");

//**************VARIABLES************************/
$contenu='';

//***********************************/
require_once("fonctions_inc.php");
?>
