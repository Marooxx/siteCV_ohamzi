<?php
//******************* On va créer une fonction pour  les membres********************
// //////////// FONCTIONS MEMBRES////////////////////////////////////////////////
function executeRequete($req)
{
	global $mysqli;
	$resultat = $mysqli->query($req);
	if(!$resultat)
	{
	 die("Erreur sur la requête sql.<br>Message : " .$mysqli->error."<br>Code : ".$req );// si la requête échoue on va "mourir(die)" avec le message d'erreur
	 // mysqli-> error permet de piocher les informations dans la variable pour savoir si il existe des erreurs
		// avec die() , le script s'interrompt.

	}
	return $resultat;
	// on retourne un objet issu de la classe mysqli_result(en cas de requête SELECT, autre requête: true ou false)
}
executeRequete("SELECT*FROM produit");
/*********************************Commentaires

"global mysqli " permet d'avoir accès à la variable $mysqli définie dans l'espace global à l'intérieur de notre fonction ( espace local)

$resultat = $mysqli->query($req);==>On exécute la requête reçue en argument
*/

/////////*** FONCTION DEBUG******************************************************//
//debug($_POST);
function debug($var,$mode = 1){//$var va réceptionner et va permetter de comparer une variable
	echo '<div style="background:orange;padding:5px; float:right;clear:both;">';
	$trace = debug_backtrace();// permet de retourner des infos sur le fichier et la ligne sur lesquels ont travaille
	$trace = array_shift($trace);// va selectionner la 1ere partie du tableau
	echo"Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].<hr>";
	if($mode==1){
		echo"<pre>";print_r($var);echo'</pre>';
	}
	else{
		echo"<pre>";var_dump($var);echo'</pre>';

	}
	echo "</div>";
}
/*///////commentaires/
Cette fonction va nous éviter d'avoir à effectuer des"print_r" et des "var_dump".
++ la fonction "debug_backtrace()" est une fonction prédéfinie retournant un tableau ARRAY contenant des infos tel que la ligne et le fichier où est éxécutée la fonction
++ "array_shift" extrait la première valeur d'un tableau et la retourne
*/
//**********************************
// fonction va savoir si l'internaute est connecté
function internauteConnecte(){
	if(!isset($_SESSION['membre'])){
// si la session "membre" est non définie( elle ne peux être que définie si nous sommes passés par la page connexion avec le bon mot de passe)
		return false;
	}
	else{
		return true;
	}
}
/*----------------------Commentaires-----------------------
Cette fonction m'indique si le membre est connecté (une fonction retourne toujours false par défault)

/******************************************************/
// fonction pour connaître si l'internaute est admin  ou simple membre
function statutMembre(){// statut = Admin
	if(internauteConnecte() && $_SESSION['membre']['statut']== 1){
// si la session membre est définie , nous regardons si il est admin. Si c'est le cas, nous retournons 'true'
		return true;
	}
	return false;
	// on ne met pas de "else" car la fonction renvoie un  false par défaut
}
/*--------- Commentaires----------------------*/
/*cette fonction indique si le membre est admin*/

/**** PANIER /COMMANDE/PAIEMENT*****/
//--------------- PANIER / COMMANDE / PAIEMENT --------------//
function creationPanier()
{
// Crrer un tableau qui s'appelle panier qui permet de stocker les infos pour le titre, l'id_produit, la quantité et le prix
	if(!isset($_SESSION['panier']))
	{
		$_SESSION['panier'] = array();
		$_SESSION['panier']['titre'] = array();
		$_SESSION['panier']['id_produit'] = array();
		$_SESSION['panier']['quantite'] = array();
		$_SESSION['panier']['prix'] = array();
	}
}
//Soit le panier n'existe pas, on le crée, on retourne TRUE
//soit le panier éxiste déjà, on retourne directement TRUE
//------------------------------------------------
// Cette fonction permet d'ajouter un produit au panier
function ajouterProduitDansPanier($titre,$id_produit,$quantite,$prix)
{
	creationPanier();
	// Nous devons savoir si l'id_produit que l'on souhaite ajouter, est déjà présent dans la session du panier ou non

	$position_produit=array_search($id_produit,$_SESSION['panier']['id_produit']);
	if($position_produit!=false)//retourne un chiffre pour savoir  si le produit existe
	{
		$_SESSION['panier']['quantite'][$position_produit] += $quantite;
		// Nous allons directement à l'indice de ce produit et nous ajoutons la nouvelle quantité
	}
	else
	// sinon  si l'id_produit du produit ciblé n'existe pas dans le panier,on ajoute l'id_produit du produit dans un nouvel indice du tableau.

	{
		// on crée des variables de réceptions
		$_SESSION['panier']['titre'][]=$titre;// les crochets[] vides permettent de mettre ou passer à  l'indice suivant
		$_SESSION['panier']['id_produit'][]=$id_produit;
		$_SESSION['panier']['quantite'][]=$quantite;
		$_SESSION['panier']['prix'][]=$prix;

	}

}

/************************ FONCTION MONTANT TOTAL*****************************/
function montantTotal()
{
	$total = 0;
	for($i=0; $i<count($_SESSION['panier']['id_produit']);$i++)
	{// la boucle va se positionner à l'indice de mon tableau
	// TANT QUE $i est inférieur au nombre de produit dans le panier(suite)
		$total += $_SESSION['panier']['quantite'][$i]*$_SESSION['panier']['prix'][$i];
	}/*(suite) on va multiplier la quantite par le prix
	exp= 1*10€ ou 3*10€ sans remplacer, pour autant, la dernière valeur contenu dans la variable $total
	 */
	return round($total,2);
	//prix total pour tous les produits avec 2 chiffres après la virgule max.
}
/*************************** RETIRER UN PRODUIT DU PANIER***************************/
function retirerProduitDuPanier($id_produit_a_supprimer)
{
	$position_produit = array_search($id_produit_a_supprimer,$_SESSION['panier']['id_produit']);
	# array_search () permet de rechercher l'id du produit
	if ($position_produit !=false)
	{
		array_splice($_SESSION['panier']['titre'],$position_produit,1);
		array_splice($_SESSION['panier']['id_produit'],$position_produit,1);
		array_splice($_SESSION['panier']['quantite'],$position_produit,1);
		array_splice($_SESSION['panier']['prix'],$position_produit,1);
	}   # array_splice permet de remonter les indices ,de remplacer un indice et de supprimer 1 seule ligne
}
