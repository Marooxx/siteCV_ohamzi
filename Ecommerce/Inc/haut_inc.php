
<!DOCTYPE html>
<html>
  <head>
    <title>Mon site</title>
	<link rel="stylesheet" href="/github/PHP/Ecommerce/Inc/css/style.css">
<!-- c'est ici qu'on indiquera l'adresse URL de notre site-->
	</head>
	<body>
	 <header>
	    <div class="conteneur">
			<span>
				<a href="" title="Mon site">Mon site.com</a>
			</span>
			<nav>

			<?php
			if(statutMembre()){
				echo'<a href="' .URL.'admin/gestionMembres.php">Gestion des membres</a>';
				echo'<a href="'.URL.'admin/gestionCommandes.php">Gestion des commandes</a>';
				echo'<a href="'.URL.'admin/gestionBoutique.php">Gestion de la boutique</a>';
			}
			if(internauteConnecte()){
				/* "if" et non "else if" afin que cette condition s'applique aux membres et aux
				admins*/
				// en ne mettant pas de "else if", cela donne à l'administrateur l'accès à tout le site et donc au second "if". Le second "if" sera aussi évalué.
				echo'<a href="' .URL.'profil.php">Voir mon profil</a>';
				echo'<a href="' .URL.'boutique.php">Accès à la boutique</a>';
				echo'<a href="' .URL.'panier.php">Voir votre panier</a>';
				echo'<a href="' .URL.'connexion.php?action=deconnexion">Se déconnecter</a>';
			}
			else{// le cas par défault sera le visiteur non membre
				echo'<a href="' .URL.'inscription.php">Inscription</a>';
				echo'<a href="' .URL.'connexion.php">Connexion</a>';
				echo'<a href="' .URL.'boutique.php">Voir la boutique</a>';
				echo'<a href="' .URL.'panier.php">Voir mon panier</a>';

			}
			/* visiteur= 4 liens
			   membre = 4 liens
			   Admin = 7 liens
			*/

			?>
			<nav>
		</div>
	</header>
	<section>
	<div class="conteneur">
