<?php
// Sessicon d'identification
    
session_start();// à mettre sur toutes les pages de l'admin; SESSION et authentification
    if(isset($_SESSION['connexion']) && $_SESSION['connexion']='connecté'){
        $id_utilisateur = $_SESSION['id_utilisateur'];
        $prenom = $_SESSION['prenom'];
        $nom = $_SESSION['nom'];
    }else{// l'utilisateur n'est pas connecté
        header('location:login.php');
    }
// pour se déconnecter
if(isset($_GET['deconnect'])){// on récupère le terme quitter dans l'url 
    $_SESSION['connexion'] ='';// on vide les variables de session
    $_SESSION['id_utilisateur'] ='';// on vide les variables de session
    $_SESSION['prenom'] ='';// on vide les variables de session
    $_SESSION['nom'] ='';// on vide les variables de session
    $_SESSION['email'] ='';// on vide les variables de session

    unset($_SESSION['connexion']);
    session_destroy();
    
    header('location:index.php');
}

?>
