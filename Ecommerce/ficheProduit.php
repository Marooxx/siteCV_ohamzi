<?php
require_once("Inc/init.php");
//****************** TRAITEMEMENT PHP***************************
//on récupère l' ID_PRODUIT dans l'Url
if(isset($_GET['id_produit']))
{
	$resultat = executeRequete("SELECT * FROM produit WHERE id_produit ='$_GET[id_produit]'");
	// on sélectionn tous les informations de la table produit à condition que id_produit de la table soit égale à l'id_produit de l'Url
}	
	if($resultat->num_rows<= 0)// si num_rows est <0 , on retourne sur la fiche boutique.on va compter le nombre de résultat,on compte le nombre de ligne
	{
		header("location:boutique.php");//si le if est appliqué on retourne à la page boutique 
		exit();// fonction prédéfinie qui arrête le script et on sort de la page
	}
	


$produit = $resultat->fetch_assoc();
$contenu .="<h3>Titre : $produit[titre]</h3><hr><hr>";
$contenu .="<h3>Catégorie : $produit[categorie]</h3><hr><hr>";
$contenu .="<h3>Couleur : $produit[couleur]</h3><hr><hr>";
$contenu .="<h3>Taille : $produit[taille]</h3><hr><hr>";
$contenu .="<img src='$produit[photo]' width='150' height='150'>";
$contenu .="<p><i>Description : $produit[description]</i></p><br>";
$contenu .="<p>Prix : $produit[prix] €</p><br>";

if($produit['stock'] >0)// si mon stock est supérieur à zéro
{
	$contenu .="<i>Nombre de produit(s) disponible : $produit[stock]<i><br><br>";
	$contenu .='<form method="post" action="panier.php">';
	$contenu .="<input type='hidden' name='id_produit' value='$produit[id_produit]'>";// on récupère l'id produit en masqué
	$contenu .="<label for='quantite'>Quantité : </label>";
	$contenu .="<select  name='quantite' id='quantite'>";
				for($i=1;$i <=$produit['stock'] && $i <=5;$i++)
				{
					$contenu .= "<option>$i</option>";
				}
	$contenu .="</select>";
	$contenu .= '<input type="submit" name="ajout_panier" value="Ajouté(s) au  panier">';
	$contenu .="</form>";
				}
	
	else
	{
		$contenu .="Rupture de stock, en cours de réapprovisionnement!";
	}
	$contenu.="<br><button><a href='boutique.php?categorie=" . $produit['categorie']."'> Retour vers la sélection de ".$produit['categorie']."</a></button>";




























































require_once("Inc/haut_inc.php");
echo $contenu;
require_once("Inc/bas_inc.php");

?>