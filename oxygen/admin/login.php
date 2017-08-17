<?php require '../connexion/connexion.php' ?>
<?php
session_start();// à mettre dans toutes les pages de l'admin : SESSION et authentification
$msg_login_error = '';// on initialise la variable en cas d'erreur

if (isset($_POST['connexion'])) { // on envoie le form avec le name du bouton ( lorsque l'on clique sur le bouton login)
    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);

    $sql = $pdocv->prepare(" SELECT * FROM t_utilisateurs WHERE email = '$email' AND mdp = '$mdp'  ");// on vérifie le mail et mdp
    $sql->execute();

    $nbr_utilisateurs = $sql->rowCount();// on compte s'il il y'est , le compte répond  '1' si il y'est et '0' si il n'y est pas
    if ($nbr_utilisateurs==0) {
        $msg_login_error = " Erreur d'authentification ! ";

    }else{ // on le trouve si la personne est inscrite
        $ligne_utilisateur = $sql->fetch();// on retrouve les infos de la personne inscrite
        $_SESSION['connexion']='connecté';
        $_SESSION['id_utilisateur']=$ligne_utilisateur['id_utilisateur'];
        $_SESSION['prenom']=$ligne_utilisateur['prenom'];
        $_SESSION['nom']=$ligne_utilisateur['nom'];

        header('location:index.php');


    }// ferme le if else
}// ferme if isset

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Login</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/login.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    </head>
    <div class="wrapper">
        <div>
            <form class="form-signin" action="login.php" method="post">
                <h2 class="form-signin-heading">Please login</h2>
                <input type="email" class="form-control" name="email" placeholder="Email" required="" autofocus="" />
                <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" required="" />
                <label class="checkbox">
            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
        </label>
                <b></b> <input class="btn" name="connexion" type="submit" value="connexion">
            </form>
        </div>
