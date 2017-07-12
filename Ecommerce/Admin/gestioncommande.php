<?php
require_once("../Inc/init.php");

if (!statutMembre())
{
header("location:../connexion.php");// cette fonction permet de rediriger l'internanute vers la page souhaitée
exit();
}

//-----------AFFICHAGE------------
require_once("../Inc/haut_inc.php");
echo "<h1> Voici les commandes passées</h1>";
echo "<table border='1'><tr>";
$information_sur_les_commandes = executeRequete("SELECT c.*,m.pseudo,m.adresse,m.ville,m.code_postal FROM commande c LEFT JOIN membre m ON m.id_membre = c.id_membre");// c'est une jointure de table entre la table membre et commande
// lorsque l'on fait une requête à partir d'une variable mysqli , elle devient une variable de la classe mysqli_result
echo "Nombre de commande : " .$information_sur_les_commandes->num_rows;
echo "<table style='border-color=black' border=1</tr>";
while ($colonne = $information_sur_les_commandes->fetch_field())
{
    echo "<th>".$colonne->name."</th>";
    //
}

echo "</tr";

$chiffre_affaire=0;
while ($commande = $information_sur_les_commandes->fetch_assoc() )
{//$commande est un tableau car on va utiliser la methode fectch_assoc pour en extraire(afficher) les données du tableau
    $chiffre_affaire +=$commande['montant'];
    //$chiffre_affaire=$chiffre_affaire+ $information_sur_les_commandes
    echo "<div>";
    echo "<tr>";

    // j 'envoi les informations dans l'url
    echo '<td><a href="?suivi=' .$commande['id_commande'].'">Voir la commande '.$commande['id_commande']."</a></td>";

    // ici on va afficher grâce àla boucle while , l'ensemble des données d'un tableau
    echo "<td>".$commande['id_commande']."</td>";
    echo "<td>".$commande['id_membre']."</td>";
    echo "<td>".$commande['montant']."</td>";
    echo "<td>".$commande['date_enregistrement']."</td>";
    echo "<td>".$commande['etat']."</td>";
    echo "<td>".$commande['pseudo']."</td>";
    echo "<td>".$commande['adresse']."</td>";
    echo "<td>".$commande['ville']."</td>";
    echo "<td>".$commande['code_postal']."</td>";
    echo "</tr>".$commande['id_commande']."</td>";
    echo "</div>";
}
echo'</table><br>';
echo'Calcul du montant total des revenus en €  : <br>';
echo "Le chiffre d'affaires de la société est de :". $chiffre_affaire ."<br>";
echo "<br>";


// details_commande
if (isset($_GET['suivi']))
{// lorsque je clique sur le lien "voir commande " , il v a s'afficher dans l'url ?suivi. Je rentre dans le if
    echo '<h1> Voici le détails pour une commande</h1>';
    echo "<table border='1'>";
    echo '<tr>';
    $information_sur_les_commandes= executeRequete("SELECT * FROM details_commande WHERE id_commande=$_GET[suivi]");
    while ($colonne =$information_sur_les_commandes->fetch_field() )
    {
        echo '<th>'.$colonne->name.'</th>';
    }
        echo "<tr>";


    while ($details_commande = $information_sur_les_commandes->fetch_assoc())
    {
        echo '<tr>';
        echo "<td>".$details_commande['id_details_commande'].'</td>';
        echo "<td>".$details_commande['id_commande'].'</td>';
        echo "<td>".$details_commande['id_produit'].'</td>';
        echo "<td>".$details_commande['quantite'].'</td>';
        echo "<td>".$details_commande['prix'].'</td>';
        echo "</tr>";
    }
    echo "</table>";
}
?>
