<?php
require_once("../Inc/init.php");
//---------- SUPPRESSION PRODUIT----------------
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{
$contenu .='<div class="validation">Suppression de produit : ' . $_GET['id_produit'] . '</div>';
$resultat = executeRequete("DELETE FROM produit WHERE id_produit= '$_GET[id_produit]'");
$_GET['action']='affichage';
}
//debug($_POST);// on vérifie tous les champs
//--------------- ENREGISTREMENT DE PRODUIT------------------------
if(!empty($_POST)){
	$photo_bdd="";
	if(isset($_GET['action']) && $_GET['action'] == 'modification')
	{
		$photo_bdd = $_POST['photo_actuelle'];// on récupère le chemin de la photo(URL) qui s'inscrit dans l'url via le formulaire
	}
	if(!empty($_FILES['photo']['name'])){
		//debug($_FILES);
		$nom_photo = $_POST['reference']."_".$_FILES['photo']['name'];// cette variable sert à donner un nom à la photo
		$photo_bdd = URL. "Photos/$nom_photo";// chemin de la base de donnée du nom de la photo
		$photo_dossier = RACINE_SITE . "Photos/$nom_photo";// c'est là que sera copié la photo
		copy($_FILES['photo']['tmp_name'],$photo_dossier);// copy() permet de faire une copie du chemin de la photo et on la stocke  dans le dossier photo
	}
		foreach($_POST as $indice=>$valeur){
			$_POST[$indice] = htmlentities(addSlashes($valeur));// traduit le html avec htmlentities()
		}
		// Executer une requête d'insertion permettant d'insérer un produit dans la base
		executeRequete("REPLACE INTO produit (id_produit,reference,categorie,titre,description,couleur,taille,public,photo,stock,prix) VALUES('$_POST[id_produit]','$_POST[reference]','$_POST[categorie]','$_POST[titre]','$_POST[description]','$_POST[couleur]','$_POST[taille]','$_POST[public]','$photo_bdd','$_POST[stock]','$_POST[prix]')");
		$contenu.="<div class='validation'>Votre produit a bien été enregistré</div>";
		$_GET['action'] = 'affichage';

	}
//------------- LIENS PRODUITS------------//
$contenu .= '<a href="?action=affichage">Affichage des produits</a><br>';
$contenu .= '<a href="?action=ajout">Ajout d\'un produit</a><br><br><br>';

//---------------- AFFICHAGE PRODUITS--------------------------//
if(isset($_GET['action']) && $_GET['action'] == 'affichage'){// Au momemnt où on clique , on rentre dans la condition
	$resultat = executeRequete("SELECT*FROM produit");// on sélectionne tous les produits
	$contenu .= '<h2> Affichage des produits</h2>';
	$contenu .= 'Nombre de produits dans la boutique : '.$resultat->num_rows;// on compte le nombre de produits dans la table "produit" grâce à num_rows
	$contenu .= '<table border = "1" cellpadding ="5"><tr>';

	while($colonne = $resultat->fetch_field()){// on récupère le nom des champs
		$contenu .='<th>'. $colonne->name . '</th>';// affiche le nom de colonne de chaque champs
	}// $colonne faite de la classe STD
	// on crée 2 entêtes supplementaires : suppression et modification
		$contenu .='<th>Modification</th>';
		$contenu .='<th>Suppression</th>';
		$contenu .= '</tr>';


	while($ligne = $resultat->fetch_assoc()){/* on transforme $ligne en tableau par la méthode fetch_assoc()
) et rend les informations de $resultat exploitable*/
		$contenu .='<tr>';
		foreach($ligne as $indice=>$information){//foreach(..as..) va parcourir tout le tableau pour récolter les infos
			if($indice =="photo"){
			// on donne une dimension au image
				$contenu .='<td><img src="' .$information . '"width="70" height="70"></td>';
			}
			else{
				//sinon elle affiche les informations normalement
				$contenu .='<td>' . $information . '</td>';
			}


		}
		// en fonction de l'id_produit que j'envois sur l'url , cela lance l'action suppression ou modification
		$contenu .= '<td><a href="?action=modification&id_produit='.$ligne['id_produit'] .'"><img src="../Inc/img/edit.png"></a></td>';
		$contenu .= '<td><a href="?action=suppression&id_produit='.$ligne['id_produit'] .'"onClick="return(confirm(\'Êtes vous certain de vouloir supprimer cet article?\'));"><img src="../Inc/img/delete.png"></a></td>';


		$contenu .="</tr>";

	}
	$contenu .="</table><br><hr><br>";

}


require_once("../Inc/haut_inc.php");
echo $contenu;
// Exercice: dans le fichier "gestionBoutique",réaliser un formulaire html correspondant à la table produit
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification'))
{
	if(isset($_GET['id_produit']))
	{

		$resultat = executeRequete("SELECT*FROM produit WHERE id_produit= $_GET[id_produit]");// on récupère les informations sur l'article à modifier
		$produit_actuel = $resultat->fetch_assoc();/*on rend les informations exploitables afin de les présaisir dans les cases du formulaire*/

	}
	//  Au moment où je clique sur modification , je récupère les données du produit
	$id_produit = (isset($produit_actuel['id_produit']))?$produit_actuel['id_produit']:'';
	$reference = (isset($produit_actuel['reference']))?$produit_actuel['reference']:'';
	$categorie = (isset($produit_actuel['categorie']))?$produit_actuel['categorie']:'';
	$titre = (isset($produit_actuel['titre']))?$produit_actuel['titre']:'';
	$description = (isset($produit_actuel['description']))?$produit_actuel['description']:'';
	$couleur= (isset($produit_actuel['couleur']))?$produit_actuel['couleur']:'';
	$taille= (isset($produit_actuel['taille']))?$produit_actuel['taille']:'';
	$public = (isset($produit_actuel['public']))?$produit_actuel['public']:'';
	$photo = (isset($produit_actuel['photo']))?$produit_actuel['photo']:'';
	$stock = (isset($produit_actuel['stock']))?$produit_actuel['stock']:'';
	$prix = (isset($produit_actuel['prix']))?$produit_actuel['prix']:'';








// on va crée un champs caché pour pouvoir récupérer  les données de l'id_produit
echo'<form method="post" enctype="multipart/form-data" action="">
<h2>FORMULAIRE DES PRODUITS</h2><br>

<input type="hidden" id="id_produit" name="id_produit" value="'.$id_produit.'"><br>

<label for="reference">Référence</label><br>
<input id="reference" type="text" name="reference" placeholder="référence produit" value="'.$reference.'"><br><br>

<label for="categorie">Categorie</label><br>
<input id="categorie" type="text" name="categorie" placeholder="Catégorie" value="'.$categorie.'"><br><br>

<label for="titre">Titre</label><br>
<input id="titre" type="text" name="titre" placeholder="Nom du produit" value="'.$titre.'"><br><br>

<label for="description">Description</label><br>
<textarea rows="10" cols="50" name="description" placeholder="Vous pouvez écrire quelque chose ici">'.$description.'</textarea><br><br>

<label for="couleur">Couleur</label><br>
<select id="couleur" name="couleur">
<option value="bleu"';if($couleur=='bleu') echo 'selected'; echo'>bleu</option>
<option  value="orange"';if($couleur=='orange') echo 'selected'; echo'>orange</option>
<option value="jaune"';if($couleur=='jaune') echo 'selected'; echo'>jaune</option>
<option value="vert"';if($couleur=='vert') echo 'selected'; echo'>vert</option>
</select><br><br>

<label for="taille">Taille</label><br>
<select id="taille" name="taille" >
<option value="s"';if($taille=='s') echo 'selected';echo '>S</option>
<option value="m"';if($taille== 'm') echo 'selected';echo'>M</option>
<option value="l"';if($taille=='l') echo 'selected';echo'>L</option>
<option value="xl"';if($taille=='xl') echo 'selected'; echo'>XL</option>
<option value="xxl"';if($taille=='xxl') echo 'selected';echo'>XXL</option>
</select><br><br>

<label for="public">Public</label><br>
<input type="radio" name="public" value="m"';if($public=='m') echo 'checked';echo' checked>Homme
<input type="radio" name="public" value="f"';if($public=='f') echo 'checked';echo'>Femme
<input type="radio" name="public" value="mixte"';if($public=='mixte') echo 'checked';echo'>Mixte
<br><br>

<input type="hidden"  name="photo_actuelle"><br>
<label for="photo">Photo</label><br>
<input id="photo" type="file" name="photo" placeholder="Votre photo" value="'.$photo.'"><br><br>';
if(!empty($photo))
{
	echo'<i>Vous pouvez uploader une nouvelle photo si vous souhaitez la modifier</i><br>';
	echo'<img src="'.$photo.'" width="90" height="90"><br>';
}
echo'
<label for="stock">Stock</label><br>
<input id="stock" type="text" name="stock" placeholder="stock" value="'.$stock.'"><br><br>

<label for="prix">Prix</label><br>
<input id="prix" type="text" name="prix" placeholder="prix" value="'.$prix.'"><br><br>

<input type="submit" value="';echo ucfirst($_GET['action']).'du produit">

</form>';
}
require_once("../Inc/bas_inc.php");
// on va récupérer les données de l'url via le formulaire grâce au "value"
