
<?php
require_once('Inc/init.php');
require_once('Inc/haut_inc.php');

//debug($_POST);
if($_POST){
	//--------------CONTROLE ET ERREURS------------------------------------
	$error='';// la variable sert à tester les différents arguments qu'on aura à utiliser
	//controle dela taille du pseudo
	if(strlen($_POST['pseudo'])<=3 || strlen($_POST['pseudo']>20)){
	$error="<div class='error'>Erreur de la taille du pseudo</div>";
	}
	
	// contrôle du format(pseudo)
	if (!preg_match('#^[a-zA-Z0-9-_]+$#',$_POST['pseudo']))
	{
		$error.="<div class='error'>Erreur de la taille/format du pseudo</div>";
	}
// preg_match() va controler les caractères utilisés
// ^ pour le debut de la chaine de caractere et le $ pour indiquer la fin 
// le + va permettre d'utiliser plusieurs fois les caractères mentionnés dans la fonction
//controle de la disponibilité du pseudo 
$result=executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");// selection du pseudo dans la base de donnée

// condition pour savoir si le pseudo est disponible ou non
if($result->num_rows>=1){// num_rows va permettre de calculer le nombre de resultat obtenu
	$error.="<div class='error'>Pseudo est indisponible!</div>";
	
}   
//----- VALIDATION ET INSCRIPTION MEMBRE--------------
if(empty($error)){
	// faire une requête d'insertion  en BDD, afficher un message lorsqu'un membre est bien inscrit et faites des tests de contrôle
	// cryptage du mot de passe
	//$_POST['mdp'] = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
	executeRequete("INSERT INTO membre (pseudo,mdp,nom,prenom,email,civilite,ville,code_postal,adresse) VALUES('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[civilite]','$_POST[ville]','$_POST[code_postal]','$_POST[adresse]')");
	$contenu.="<div class='validation'>Vous êtes inscrit à notre site web.<a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
}
else{
	$contenu.=$error;
}

require_once("inc/haut_inc.php");
echo $contenu;
/* la fonction preg_match() est une fonction prédéfinie permettant de gérer les expressions régulières. Elle est toujours entrourée de "#" afin de préciser les options:
"^" indique le début de la chaîne /sinon la chaîne pourrait commencer par autre chose.
"$" indique la fin de la chaîne sinon la chaîne pourrait terminer par autre chose
le "+" est là pour indiquer les lettres autorisées peuvent être utisées plusieurs fois sinon on pourrait utiliser une seul fois la lettre B par exemple.
*/
}
?>
<form action="" method="post">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="Votre pseudo" pattern="[a-zA-Z0-9-_.]{3,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" required="required"><br><br>

    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" placeholder="Votre nom"><br><br>

    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" placeholder="Votre prénom"><br><br>

    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br><br>

    <label for="civilite">Civilité</label><br>
    <input type="radio" id="civilite" name="civilite" value="m" checked>Homme
    <input type="radio" id="civilite" name="civilite" value="f">Femme<br><br>

    <label for="ville">Ville</label><br>
    <input type="text" id="ville" name="ville" placeholder="Votre ville" pattern="[a-zA-Z0-9-_.]{3,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br><br>

    <label for="code_postal">Code postal</label><br>
    <input type="text" id="code_postal" name="code_postal" placeholder="Votre code postal" pattern="[0-9]{5}" title="caractères acceptés : [0-9]"><br><br>
	
	<label for="adresse">Adresse</label><br>
	<textarea type="text" id="adresse" name="adresse" placeholder="Votre adresse" pattern="[a-zA-Z0-9-_.] {5,15}"
	titre="caractères acceptés : a-zA-Z0-9-_."></textarea><br><br>
	
	
	
	<input type="submit" name="inscription" value="S'inscrire">
	
</form>
<?php
require_once("Inc/bas_inc.php");


?>








