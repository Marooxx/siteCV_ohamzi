<?php require '../connexion/connexion.php' ?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Test connection</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
$sql = $pdocv->query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1' ");
$ligne = $sql->fetch();// va chercher information

?>
	<p> Hello ! <?php echo $ligne['prenom'].' '.$ligne['nom'];?></p>
</body>
</html>
