

<?php
require_once ('Inc/init.php');
//----------------- TRAITEMENT PHP----------------------

if(isset($_GET['action']) && $_GET['action'] == "deconnexion"){
	session_destroy();
}
debug($_GET);
if(internauteConnecte()){
/* si l'internanute est déjà connecté, il n 'a rien à faire sur la page connexion
Nous le redirigeons sur la page profil.De cette manière, nous afficherons le formulaire de connxion uniquement aux membres non connectés*/
	header("location:profil.php");
}
require_once ('inc/haut_inc.php');

?>
<form method="post">
<h2> Connexion</h2><br />

<label for="pseudo"> Votre Pseudo</label><br />
<input id="pseudo" name="pseudo" type="text" placeholder="Votre pseudo"><br /><br />

<label for="mdp">Votre mot de passe svp</label><br />
<input type="text" id="mdp" name="mdp" placeholder="Saisissez votre mot de passe ici"><br /><br />

<input type="submit" value="Se connecter">

</form>
<?php

if ($_POST)
	{
	$resultat = executeRequete("SELECT*FROM membre WHERE pseudo='$_POST[pseudo]'");
	if ($resultat->num_rows != 0) // si num_rows different de 0 alors on rentre dans le "if"-- on compte la quantité des pseudos
		{
		$membre = $resultat->fetch_assoc(); // on transforme les informations contenu dans $membre sous forme de tableau
		if ($membre['mdp'] == $_POST['mdp'])
			// if(password_verify($_POST['mdp'],$membre['mdp'])) , on compare le mot de passe taper avec le mot de passe enregistrer dans la base
			{
			foreach($membre as $indice => $element)
				{
				if ($indice != 'mdp')
					{
					$_SESSION['membre'][$indice] = $element; // on crée une session avec les éléments provenant de la BDD si $indice != de mot de passe
					}
				  else
					{
					$contenu.= '<div class="error">Erreur de mot de passe </div>';
					}
				}

			header("location:profil.php");// si le pseudo et le mot de passe sont correctes , on est envoyé sur la page "profil.php"
			$contenu.= '<div class="error">Erreur de Pseudo </div>';
			}
		  else
			{
			$contenu.= '<div class="error"> Veuillez entrer un mot de passe valide!</div>';
			}
		}
	  else
		{
		$contenu.= '<div class ="error"> Erreur dans votre pseudo!</div>';
		}
	}
echo $contenu
?>

<?php
require_once ('Inc/bas_inc.php');

?>