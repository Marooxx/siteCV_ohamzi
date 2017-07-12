<?php
require_once("Inc/init.php");

?>
<?php
//*******************TRAITEMENT PHP**********************************
//-----------------AFFICHAGE CATEGORIE--------------------------//
$categories_des_produits=executeRequete("SELECT DISTINCT categorie FROM produit");
$contenu .='<div class="boutique-gauche">';
$contenu .= "<ul>";

while($cat = $categories_des_produits->fetch_assoc())// TANT QU'il y aura des catégories la boucle tournera
{
	$contenu .= "<li><a href='?categorie=" . $cat['categorie'] . "'>" .$cat['categorie']. "</a></li>";
}
$contenu .="</ul>";
$contenu .= "</div>";

//------------------- AFFICHAGE DES PRODUITS------------------------------------
$contenu .="<div class='boutique-droite'>";
if(isset($_GET['categorie']))// une action se lance lorsque l'on clique sur un lien.On récupère le type de catégorie une fois sur le URL. On entre donc dans le IF
{
	$donnees=executeRequete("SELECT id_produit,reference,titre,photo,prix FROM produit WHERE categorie ='$_GET[categorie]'");

	while($produit = $donnees->fetch_assoc())// la boucle va tourner tant qu'il y aura d"éléments en lien avec la catégorie(titre,photo,id_produit,prix)
	{
		//debug($produit);
		// on crée à chaque tour de boucle une DIV avec son contenu
		$contenu .='<div class="boutique-droite">';
		$contenu .="<h3>$produit[titre]</h3>";
		$contenu .="<a href=\"ficheProduit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" width=\"130\" height=\"100\"></a>";
		$contenu .="<p>$produit[prix] €</p>";
		$contenu .= '<a href="ficheProduit.php?id_produit='.$produit['id_produit'].'">Voir la fiche</a>';
		$contenu .='</div>';
	}

}
$contenu .="</div>";












































require_once("Inc/haut_inc.php");
echo $contenu;
require_once("Inc/bas_inc.php");

?>
