
<?php require '../connexion/connexion.php';  ?>
<?php require ("../include/session_inc.php");  ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>



<?php
## GEstion du contenu
## insertion d'une competences
## gestion des contenus
	
    
          # insertion d'une formation
		if(isset($_POST['formation'])){ // si onn recupere une nouvelle formation
           
            ##si compétencde n'est pas vide
        $titre = addslashes($_POST['formation']);
        $dates = addslashes($_POST['dates_f']);
        $sous_titre = addslashes($_POST['sous_titre_f']);
        $description = addslashes($_POST['description_f']);
       
            # Requête d'insertion pour la formation
        $pdocv->exec("INSERT INTO t_formations VALUES (NULL, '$titre','$sous_titre','$dates','$description', '$id_utilisateur') ");//mettre $id_utilisateur quand on l'aura en variable de Session
            header("location: formation.php");
				exit();
			}# ferme le if
		

	          ## Suppression d'une formation 
		if(isset($_GET['id_formation'])){
			$eraser= $_GET['id_formation'];
			$sql = " DELETE FROM t_formations WHERE id_formation = '$eraser' ";
			$pdocv -> query($sql);// ou on peut avec exec
			header("location: ../admin/formation.php");
		}

	?>






<?php
$sql = $pdocv->query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
$ligne_utilisateur = $sql->fetch();// va chercher information
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Formation  <?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom'];?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   
</head>

<body>
<!-- Debut Nav -->
<?php require( "../include/nav_inc.php");?>
<!-- Fin de la Nav -->




    
        <div id="page-wrapper">

            <div class="container-fluid">
                <?php
                    $formation = $pdocv->prepare("SELECT * FROM t_formations WHERE utilisateur_id = '$id_utilisateur' ORDER BY formation ASC ");
                    $formation->execute();// execute la
                    $nbr_formations = $formation->rowCount();
                ?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">FORMATIONS</h1>
                        <p> Il y a <?php echo $nbr_formations; ?> formations  <?php echo $ligne_utilisateur['pseudo']; ?> </p>


                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i>FORMATIONS
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>Formations</th>
                                        <th>Etablissement</th>
                                        <th>Date</th>
                                        <th>Descriptif</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    <tr>
                                        <?php while ($ligne_formation = $formation->fetch()) { ?>
                                        <td><?php echo $ligne_formation['formation']; ?></td>
                                        <td><?php echo $ligne_formation['sous_titre_f']; ?></td>
                                        <td><?php echo $ligne_formation['dates_f']; ?></td>
                                        <td><?php echo $ligne_formation['description_f']; ?></td>
                                        
                                        <td><a href="modif_formation.php?id_formation=<?php echo $ligne_formation['id_formation'];?>"><span class="glyphicon glyphicon-wrench pull-right"></span></a></td>
                                        <td><a href="formation.php?id_formation=<?php echo $ligne_formation['id_formation'];?>"><span class="glyphicon glyphicon-trash pull-right"></span></a></td>
                                    </tr>
                                         <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
 <div class="row">
    
            <!-- FORMULAIRE INSERTION FORMATIONS--> 
     
     <form class="form-horizontal" method="post" action="formation.php">
    <fieldset>

    <!-- FOrmulaire des expériences -->
    <legend style="text-align:center;"> Ajout d'une formation</legend>

    <!-- Text input-->
    <div class="form-group">
      
        
        <!-- Input expérience-->
      <div class="col-md-10"><br>
      <input id="formation" name="formation" type="text" placeholder=" Formation" class="form-control input-md col-md-10"><br>
      
       
          <!-- Input entreprise--> 
      <div class="col-md-7"><br>
      <input id="etablissement" name="sous_titre_f" type="text" placeholder=" Etablissement" class="form-control input-md"><br>
      
          
           <!-- Input date -->
      <input id="date" name="dates_f" type="date" placeholder=" Date" class="form-control input-md"><br>
        
         
           
            
            <!-- Input description-->
        <div class="col-md-12">
        <textarea id="description" name="description_f" type="text" placeholder="Description" class="form-control input-md col-md-12"></textarea><br>
         <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
        <script>CKEDITOR.replace( 'description' ) </script>
          </div>
            <!-- Button Ajouter -->
        <div class="col-md-10">
        <input  type="submit" class="btn btn-primary" value="Ajouter">
        </div>
   
      
        </div>
    </div>
</div>
         
         
          

  

    </fieldset>
    </form>
</div>


                <!-- /.row -->



                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->





    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
   
   
    
