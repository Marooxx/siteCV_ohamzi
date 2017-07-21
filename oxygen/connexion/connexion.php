<?php
$hote = 'localhost'; // le chemin vers le serveur
$bdd = 'ohamzi_bd'; // nom de la BDD
$utilisateur = 'root'; //  le nom de l' utilisateur pour se connecter
$passe = ''; // mot de passe de l'utilisateur
// $passe = 'root'; // mot de passe de l'utilisateur sur mac en local

$pdocv = new PDO('mysql:host='.$hote.';dbname='.$bdd, $utilisateur, $passe);// connection à la BDD
// $pdo est le nom de la variable de la connexion qui sert partout où l'on doit se servir de la connexion
$pdocv->exec("SET NAMES utf8");
?>