<?php
require_once("Inc/init.php");
//-------- TRAITEMENT php---------------------
// Ajout panier
if (isset($_POST['ajout_panier']))
// si j'ai bien cliqué sur le bouton "ajout"
{
$resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_POST[id_produit]'");
$produit = $resultat->fetch_assoc();
ajouterProduitDansPanier($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix']);
}
//********************* VIDER PANIER ***************************//
if(isset($_GET['action'])&& $_GET['action'] == 'vider')
{
    unset($_SESSION['panier']);
}

//***************** PAIEMENT******************************//
if (isset($_POST['player']))
{
    for ($i=0; $i <count($_SESSION['panier']['id_produit']) ; $i++)
    {
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=".$_SESSION['panier']['id_produit'][$i]);
    $produit = $resultat->fetch_assoc();
    if ($produit['stock']<$_SESSION['panier']['quantite'][$i])
        {
            $contenu .="<hr><div class='error'>Stock restant(s) : " .$produit['stock']."</div>";
            $contenu .= "<div class='error'>Quantité demandée(s) : " .$_SESSION['panier']['quantite'][$i]."</div>";
            if ($produit['stock']>0)
            {
                $contenu .="<div class='error'>La quantité de produit ".$_SESSION['panier']['quantite'][$i] ." est insuffisante , veuillez vérifier vos achats </div>";
                # on va indiquer la quantité de produit disponible.
                $_SESSION['panier']['quantite'][$i] = $produit['stock'];
            }
            else
            {
                $contenu .= "<div class='error'> Le produit" .$_SESSION['panier']['id_produit'][$i] . " est en rupture de stock. Veuillez sélectionner un autre produit </div>";
                retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
                $i--;# on utilise la décrémentation pour pouvoir revenir en arrière pour  controler le produit qui remplacera le produit supprimer, et de contrôler le stock de ce dernier

            }

            $erreur = true;
        }
    }
    if (!isset($erreur))
    {
        executeRequete("INSERT INTO commande(id_membre,montant,date_enregistrement)VALUES(".$_SESSION['membre']['id_membre'].",".montantTotal().",NOW())");
        $id_commande = $mysqli->insert_id;# va contenir l'id de la dernière commande,de la dernière requête
        for ($i=0; $i <count($_SESSION['panier']['id_produit']) ; $i++)
        {
            executeRequete("INSERT INTO details_commande(id_commande,id_produit,quantite,prix)VALUES($id_commande," . $_SESSION['panier']['id_produit'][$i].",".$_SESSION['panier']['quantite'][$i].",". $_SESSION['panier']['prix'][$i].")");
            executeRequete("UPDATE produit SET stock=stock- ".$_SESSION['panier']['quantite'][$i] . " WHERE id_produit = " . $_SESSION['panier']['id_produit'][$i]);
        }
            unset($_SESSION['panier']);
            mail($_SESSION['membre']['email'],"confirmation de commande","Merci de votre commande n° de suivi est le $id_commande","From:mrgushii@gmail.com");
            $contenu .= "<div class='validation'>Merci pour votre commande.Votre n° de commande est le $id_commande</div>";
    }
}

debug($_SESSION);

//----------------------- AFFICHAGE HTML---------------------------------
require_once("Inc/haut_inc.php");
echo "<table border='1' style ='border-collapse:collapse;'cellpadding='7'>";
echo "<tr><td colspan='5'> Panier</td></tr>";
echo "<tr><th> Titre</th><th>Produit</tr><th>Quantité</th><th>Prix Unitaire</th><th>Action</th></tr>";
if (empty($_SESSION['panier']['id_produit']))
{
    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
}
else
{
        	for($i=0; $i< count($_SESSION['panier']['id_produit']); $i++)
            {
                echo "<tr>";
            echo"<td>". $_SESSION['panier']['titre'][$i]."</td>";// les crochets[] vides permettent de mettre ou passer à  l'indice suivant
            echo"<td>".$_SESSION['panier']['id_produit'][$i]."</td>";
            echo"<td>" .$_SESSION['panier']['quantite'][$i]."</td>";
            echo"<td>" .$_SESSION['panier']['prix'][$i]."</td>";
                echo "</tr>";
            }
            echo "<tr><th colspan='3'>Total</th><td colspan='2'>".montantTotal()."</td></tr>";
            if (internauteConnecte())
            {
                echo "<form method='post' action=''>";
                echo "<tr><td colspan='5'><input type='submit' name='player' value='Valider et confirmer le paiement'></td></tr>";
                echo "</form>";
            }
            else
             {
                 echo "<tr><td colspan='5'> Veuillez vous<a href='inscription.php'> inscrire </a> ou vous  <a href='connexion.php'>connecter</a> afin de pouvoir payer</td></tr>";
            }
                echo"<tr><td colspan='5'><a href='?action=vider'> Vider le panier</a></td></tr>";
        }

echo "</table><br>";
echo "<i>Règlement par carte bancaire ou paypal</i>";





















echo $contenu;
require_once("Inc/bas_inc.php");

 ?>
