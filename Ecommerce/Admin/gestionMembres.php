<?php
require_once("../Inc/init.php");

/* Réaliser la page membre
Affichage sous forme de tableau HTML l'ensemble de la table membre en BDD
Faites en sorte de pouvoir modifier et supprimer un membre
*/

//---------- SUPPRESSION MEMBRE----------------
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{
$contenu .='<div class="validation">Suppression de membre : ' . $GET['id_membre'] . '</div>';
$resultat = executeRequete("DELETE FROM membre WHERE id_membre= '$_GET[id_membre]'");
$_GET['action']='affichage';	
}
//debug($_POST);// on vérifie tous les champs 
//--------------- ENREGISTREMENT Du MEMBR------------------------
if(!empty($_POST)){
	if(isset($_GET['action']) && $_GET['action'] == 'modification')
	
	{
		foreach($_POST as $indice=>$valeur){
			$_POST[$indice] = htmlentities(addSlashes($valeur));// traduit le html avec htmlentities()
		}
		// Executer une requête d'insertion permettant d'insérer un produit dans la base
		executeRequete("REPLACE INTO membre (id_membre,pseudo,mdp,nom,prenom,email,civilite,ville,code_postal,adresse,statut) VALUES('$_POST[id_membre]','$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[civilite]','$_POST[ville]','$_POST[code_postal]','$_POST[adresse]','$_POST[statut]')");
		$contenu.="<div class='validation'>Vous avez bien été enregistré</div>";
		$_GET['action'] = 'affichage';

	} 
		

} 
//------------- LIENS MEMBRES------------//
$contenu .= '<a href="?action=affichage">Affichage des membres</a><br>';
//$contenu.="<br><button><a href='gestionMembres.php?categorie=" . $['']."'> Retour vers la page des membres ".$['']."</a></button>";

//---------------- AFFICHAGE MEMBRES--------------------------//
if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{// Au momemnt où on clique , on rentre dans la condition
	$resultat = executeRequete("SELECT*FROM membre");// on sélectionne tous les produits
	$contenu .= '<h2> Affichage des membres</h2>';
	$contenu .= 'Nombre des membres : '.$resultat->num_rows;// on compte le nombre de produits dans la table "produit" grâce à num_rows
	$contenu .= '<table border = "1" cellpadding ="5"><tr>';
	
	while($colonne = $resultat->fetch_field())
	{
		// on récupère le nom des champs 
		$contenu .='<th>'. $colonne->name . '</th>';// affiche le nom de colonne de chaque champs
	}// $colonne faite de la classe STD
	// on crée 2 entêtes supplementaires : suppression et modification
		$contenu .='<th>Modification</th>';
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
			
		$contenu .= '<td><a href="?action=modification&id_membre='.$ligne['id_membre'] .'"><img src="../Inc/img/edit.png"></a></td>';
		$contenu .= '<td><a href="?action=suppression&id_membre='.$ligne['id_membre'] .'"onClick="return(confirm(\'Êtes vous certain de vouloir nous quitter?\'));"><img src="../Inc/img/delete.png"></a></td>';
		}
		// en fonction de l'id_produit que j'envois sur l'url , cela lance l'action suppression ou modification
		
		
		
		$contenu .="</tr>";
	 
	
	$contenu .="</table><br><hr><br>";
}	


require_once("../Inc/haut_inc.php");
echo $contenu;

if(isset($_GET['action']) &&  $_GET['action'] == 'modification')
{
	if(isset($_GET['id_membre']))
	{
		
		$resultat = executeRequete("SELECT*FROM membre WHERE id_membre= $_GET[id_membre]");// on récupère les informations sur l'article à modifier
		$membre_actuel = $resultat->fetch_assoc();/*on rend les informations exploitables afin de les présaisir dans les cases du formulaire*/
		
	}
	//  Au moment où je clique sur modification , je récupère les données du membre
	$id_membre = (isset($membre_actuel['id_membre']))?$membre_actuel['id_membre']:'';
	$pseudo = (isset($membre_actuel['pseudo']))?$membre_actuel['pseudo']:'';
	$mdp = (isset($membre_actuel['mdp']))?$membre_actuel['mdp']:'';
	$nom = (isset($membre_actuel['nom']))?$membre_actuel['nom']:'';
	$prenom = (isset($membre_actuel['prenom']))?$membre_actuel['prenom']:'';
	$email= (isset($membre_actuel['email']))?$membre_actuel['email']:'';
	$civilite= (isset($membre_actuel['civilite']))?$membre_actuel['civilite']:'';
	$ville = (isset($membre_actuel['ville']))?$membre_actuel['ville']:'';
	$code_postal= (isset($membre_actuel['code_postal']))?$membre_actuel['code_postal']:'';
	$adresse= (isset($membre_actuel['adresse']))?$membre_actuel['adresse']:'';
	$statut = (isset($membre_actuel['statut']))?$membre_actuel['statut']:'';
	
	
	
	
	
	
	
	
// on va crée un champs caché pour pouvoir récupérer  les données de l'id_produit	
echo'<form method="post" enctype="multipart/form-data" action="">
<h2>FORMULAIRE DES MEMBRES </h2><br>

<input type="hidden" id="id_membre" name="id_membre" value="'.$id_membre.'"><br>

<label for="pseudo">Pseudo</label><br>
<input id="pseudo" type="text" name="pseudo" placeholder="Votre pseudo" value="'.$pseudo.'"><br><br>

<label for="mdp">Votre mot de passe</label><br>
<input id="mdp" type="text" name="mdp" placeholder="Saisissez votre mot de passe ici" value="'.$mdp.'"><br><br>

<label for="nom">Votre nom</label><br>
<input id="nom" type="text" name="nom" placeholder="Tapez votre nom" value="'.$nom.'"><br><br>

<label for="nom">Votre prénom</label><br>
<input id="nom" type="text" name="prenom" placeholder="Tapez votre prénom" value="'.$prenom.'"><br><br>

<label for="email">Votre mail</label><br>
<input id="email" type="mail" name="email" placeholder="Saisissez votre mail ici" value="'.$email.'"><br><br>

<label for="civilte">Genre</label><br>
<input type="radio" name="civilite" value="m"';if($civilite=='m') echo 'checked';echo' checked>Homme
<input type="radio" name="civilite" value="f"';if($civilite=='f') echo 'checked';echo'>Femme
<br><br>

<label for="">Ville</label><br>
<input id="ville" type="text" name="ville" placeholder="Saisissez le nom de votre ville" value="'.$ville.'"><br><br>

<label for="">Code postal</label><br>
<input id="code_postal" type="text" name="code_postal" placeholder="Votre code postal" value="'.$code_postal.'"><br><br>

<label for="adresse">Votre adresse</label><br>
<textarea rows="10" cols="50" name="adresse" placeholder="Vous pouvez écrire quelque chose ici">'.$adresse.'</textarea><br><br>



<input type="submit" value="';echo ucfirst($_GET['action']).' du membre">

</form>';
}

// on va récupérer les données de l'url via le formulaire grâce au "value"



require_once("../Inc/bas_inc.php");

?>





































































