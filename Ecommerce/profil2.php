
<?php
require_once('Inc/init.php');
require_once("Inc/haut_inc.php");
$contenu.="<p class ='centre'>Bonjour<strong>".$_SESSION['membre']['pseudo']." </strong></p><br>";
//echo $contenu;
$contenu.="<div class='cadre'><h2>Voici les informations de votre profil</h2><br>";
$contenu.='<p> Votre pseudo est :'.$_SESSION['membre']['pseudo'].'<p><br>';
$contenu.='<p> Votre nom est : '.$_SESSION['membre']['nom'].'<p><br>';
$contenu.='<p> Votre prenom est : '.$_SESSION['membre']['prenom'].'<p><br>';
$contenu.='<p> Votre ville est : '.$_SESSION['membre']['ville'].'<p><br>';
$contenu.='<p> Votre code postal est : '.$_SESSION['membre']['code_postal'].'<p><br>';
$contenu.='<p> Votre nom est : '.$_SESSION['membre']['email'].'<p><br>';

echo $contenu;
//-------------------
echo "<h2> Suivi des commandes</h2>";
$suivi_des_commandes = executeRequete("SELECT DISTINCT etat , id_commande FROM commande WHERE id_membre = '" .$_SESSION['membre']['id_membre']."'");

if ($suivi_des_commandes->num_rows>0)
{
    while ($commande = $suivi_des_commandes->fectch_assoc())
    {
        echo "Votre commande n°".$commande['id_commande']."est actuellement".$commande['etat']."<br><br>";
    }

}
else
{
echo "Aucune commande en cours";
}
echo "<br>";
echo "<div";
echo "<div class='conteneur'><h2>Vos actions possibles</h2>";
echo'<a href="membres.php">Modifier votre compte</a>';
echo'<a href="profil.php?action=supprimer" onclick="return(confirm(\'Êtes vous sûr de vouloir supprimer votre compte?\'))">Supprimer votre compte </a>';
echo "</div>";

if(isset($_GET['action'])&& $_GET['action'])
{
    executeRequete("DELETE FROM membre WHERE id_membre='".$_SESSION['membre']['id_membre']."'");
    unset($_SESSION['membre']['id_membre']);
    header("location:connexion.php?action=deconnexion");//on renvoi l'utilisateur sur la page connexion.php et on le déconnecte de la même manière
}



?>
