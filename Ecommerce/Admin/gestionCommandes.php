<?php
require_once("../Inc/init.php");

/* Réaliser la page membre
Affichage sous forme de tableau HTML l'ensemble de la table membre en BDD
Faites en sorte de pouvoir modifier et supprimer un membre
*/

//---------- SUPPRESSION MEMBRE----------------
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{
$contenu .='<div class="validation">Suppression de votre article : ' . $GET['id_commande'] . '</div>';
$resultat = executeRequete("DELETE FROM commande WHERE id_commande= '$_GET[id_commande]'");
$_GET['action']='affichage';
}
//debug($_POST);// on vérifie tous les champs
//--------------- ENREGISTREMENT DE PRODUIT------------------------
if(!empty($_POST)){
	if(isset($_GET['action']) && $_GET['action'] == 'modification')

	{
		foreach($_POST as $indice=>$valeur){
			$_POST[$indice] = htmlentities(addSlashes($valeur));// traduit le html avec htmlentities()
		}
		// Executer une requête d'insertion permettant d'insérer un produit dans la base
		executeRequete("REPLACE INTO commande (id_commande,id_membre,montant,date_enregistrement,etat) VALUES('$_POST[id_commande]','$_POST[id_membre]','$_POST[montant]','$_POST[date_enregistrement]','$_POST[etat]')");
		$contenu.="<div class='validation'>Nous avons bien enregistré votre commande</div>";
		$_GET['action'] = 'affichage';

	}


}
//------------- LIENS PRODUITS------------//
$contenu .= '<a href="?action=affichage">Affichage des commandes</a><br>';
//$contenu.="<br><button><a href='gestionMembres.php?categorie=" . $['']."'> Retour vers la page des membres ".$['']."</a></button>";

//---------------- AFFICHAGE PRODUITS--------------------------//
if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{// Au momemnt où on clique , on rentre dans la condition
	$resultat = executeRequete("SELECT*FROM commande");// on sélectionne tous les produits
	$contenu .= '<h2> Affichage des commandes</h2>';
	$contenu .= 'Nombre de commande(s) : '.$resultat->num_rows;// on compte le nombre de produits dans la table "produit" grâce à num_rows
	$contenu .= '<table border = "1" cellpadding ="5"><tr>';

	while($colonne = $resultat->fetch_field())
	{// on récupère le nom des champs
		$contenu .='<th>'. $colonne->name . '</th>';// affiche le nom de colonne de chaque champs
	}// $colonne faite de la classe STD
	// on crée 2 entêtes supplementaires : suppression et modification
		$contenu .='<th>Modification</th>';
		$contenu .='<th>Details</th>';
		$contenu .='<th>Suppression</th>';
		$contenu .= '</tr>';


	while($ligne = $resultat->fetch_assoc())
		{/* on transforme $ligne en tableau par la méthode fetch_assoc()
) et rend les informations de $resultat exploitable*/
		$contenu .='<tr>';
			foreach($ligne as $indice=>$information)
			{//foreach(..as..) va parcourir tout le tableau pour récolter les infos

				//sinon elle affiche les informations normalement
				$contenu .='<td>' . $information . '</td>';
			}

		$contenu .= '<td><a href="?action=modification&id_commande='.$ligne['id_commande'] .'"><img src="../Inc/img/edit.png"></a></td>';
		$contenu .= '<td><a href="?action=details&id_commande='.$ligne['id_commande'] .'"><img src="../Inc/img/details.png"></a></td>';
		$contenu .= '<td><a href="?action=suppression&id_commande='.$ligne['id_commande'] .'"onClick="return(confirm(\'Êtes-vous certain de vouloir annuler la commande ?\'));"><img src="../Inc/img/delete.png"></a></td>';
		}
		// en fonction de l'id_produit que j'envois sur l'url , cela lance l'action suppression ou modification



		$contenu .="</tr>";


	$contenu .="</table><br><hr><br>";
}


require_once("../Inc/haut_inc.php");
echo $contenu;

if(isset($_GET['action']) &&  $_GET['action'] == 'modification')
{
	if(isset($_GET['id_commande']))
	{

		$resultat = executeRequete("SELECT*FROM commande WHERE id_commande= '$_GET[id_commande]'");// on récupère les informations sur l'article à modifier
		$commande_actuelle = $resultat->fetch_assoc();/*on rend les informations exploitables afin de les présaisir dans les cases du formulaire*/

	}
	//  Au moment où je clique sur modification , je récupère les données du membre
	$id_commande = (isset($commande_actuelle['id_commande']))?$commande_actuelle['id_commande']:'';
	$id_membre = (isset($commande_actuelle['id_commande']))?$commande_actuelle['id_membre']:'';
	$montant = (isset($commande_actuelle['montant']))?$commande_actuelle['montant']:'';
	$date_enregistrement = (isset($commande_actuelle['date_enregistrement']))?$commande_actuelle['date_enregistrement']:'';
	$quantite = (isset($commande_actuelle['quantite']))?$commande_actuelle['quantite']:'';
	$etat= (isset($commande_actuelle['etat']))?$commande_actuelle['etat']:'';







// on va crée un champs caché pour pouvoir récupérer  les données de l'id_produit
echo'<form method="post" enctype="multipart/form-data" action="">
<h2>FORMULAIRE DES COMMANDES </h2><br>

<input type="hidden" id="id_commande" name="id_commande" value="'.$id_commande.'"><br>

<label for="id_membre">Membre</label><br>
<input id="id_membre" type="text" name="id_membre"  value="'.$id_membre.'"><br><br>

<label for="montant">Montant de votre commande</label><br>
<input id="montant" type="text" name="montant"value="'.$montant.'"><br><br>

<label for="date_enregistrement">Enregistrement de votre commande</label><br>
<input id="date_enregistrement" type="text" name="date_enregistrement" value="'.$date_enregistrement.'"><br><br>

<label for="quantite">Quantité</label><br>
<input id="quantité" type="text" name="quantite"  value="'.$quantite.'"><br><br>

<label for="etat">Etat de votre commande</label><br>
<input id="etat" type="text" name="etat"  value="'.$etat.'"><br><br>




<input type="submit" value="';echo ucfirst($_GET['action']).' de la commande">

</form>';
}


if(isset($_GET['action']) && $_GET['action'] == 'details')
{

    $resultat = executeRequete("SELECT * FROM details_commande WHERE id_commande='" . $_GET['id_commande'] . "' ");
    // si le membre a un tableau vide



				debug($_GET);
				echo "<table border='1';border-collapse=collapse>";
				echo "<thead><tr><th>N° Commande</th><th>Produit</th><th>Montant</th><th>Quantité</th><th>Détail commande</th></tr></thead>";
				while($ligne = $resultat->fetch_assoc())
				{
                echo "<tr>";

                echo "<td>".$ligne['id_commande']."</td>";
                echo "<td>".$ligne['id_produit']."</td>";
                echo "<td>".$ligne['prix']."€"."</td>";
                echo "<td>".$ligne['quantite']."</td>";
				echo "<td>".$ligne['id_details_commande']."</td>";
                echo "</tr>";
				}
				echo"</table>";
            
}







require_once("../Inc/bas_inc.php");

?>
