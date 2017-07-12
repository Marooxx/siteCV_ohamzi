
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

    <title>REALISATIONS</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   
</head>



<?php
## GEstion du contenu
## insertion d'une réalisation
## gestion des contenus
	
    
          # insertion d'une realisation
		if(isset($_POST['realisation'])){ # Récupération une nouvelle réalisation
        
            # si réalisation  n'est pas vide
        $titre = addslashes($_POST['realisation']);
        $dates = addslashes($_POST['dates_r']);
        $photo = addslashes($_POST['photo']);
        $description = addslashes($_POST['description_r']);
       
            # Requête d'insertion
        $pdocv->exec("INSERT INTO t_realisations VALUES (NULL, '$titre','$photo','$dates','$description', '$id_utilisateur') ");//mettre $id_utilisateur quand on l'aura en variable de Session
            header("location: realisation.php");
				exit();
			}# ferme le if
		

	      # Suppression d'une réalisation 
		if(isset($_GET['id_realisation'])){
			$eraser= $_GET['id_realisation'];
			$sql = " DELETE FROM t_realisations WHERE id_realisation = '$eraser' ";
			$pdocv -> query($sql);// ou on peut avec exec
			header("location: ../admin/realisation.php");
		}

	?>






<!DOCTYPE html>
<html lang="fr">

<head>
<?php
$sql = $pdocv->query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
$ligne_utilisateur = $sql->fetch(); # va chercher information
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Réalisation <?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom'];?></title>

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
                    $realisation = $pdocv->prepare("SELECT * FROM t_realisations WHERE utilisateur_id = '$id_utilisateur' ORDER BY realisation ASC ");
                    $realisation->execute();// execute la
                    $nbr_realisations = $realisation->rowCount();
                ?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">REALISATION(S)</h1>
                        <p> Il y a <?php echo $nbr_realisations; ?> réalisation(s) par  <?php echo $ligne_utilisateur['pseudo']; ?> </p>


                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i>REALISATIONS
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
                                        <th>Réalisations</th>
                                        <th> Images</th>
                                        <th>Date</th>
                                        <th>Descriptif</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    <tr>
                                        <?php while ($ligne_realisation = $realisation->fetch()) { ?>
                                        <td><?php echo $ligne_realisation['realisation']; ?></td>
                                        <td><?php echo $ligne_realisation['photo']; ?></td>
                                        <td><?php echo $ligne_realisation['dates_r']; ?></td>
                                        <td><?php echo $ligne_realisation['description_r']; ?></td>
                                        
                                        <td><a href="modif_realisation.php?id_realisation=<?php echo $ligne_realisation['id_realisation'];?>"><span class="glyphicon glyphicon-wrench pull-right"></span></a></td>
                                        <td><a href="realisation.php?id_realisation=<?php echo $ligne_realisation['id_realisation'];?>"><span class="glyphicon glyphicon-trash pull-right"></span></a></td>
                                    </tr>
                                         <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
 <div class="row">
    
            <!-- FORMULAIRE INSERTION REALISATION--> 
     
     <form class="form-horizontal" method="post" action="realisation.php">
    <fieldset>

    <!-- FOrmulaire des réalisations -->
    <legend style="text-align:center;"> Ajout d'une réalisation</legend>

    <!-- Text input-->
    <div class="form-group">
      
        
        <!-- Input réalisation-->
      <div class="col-md-10"><br>
      <input id="realisation" name="realisation" type="text" placeholder=" Réalisation" class="form-control input-md col-md-10"><br>
      
       
          <!-- Input photo--> 
      <div class="col-md-7"><br>
      <input id="photo" name="photo" type="file" placeholder=" Votre image" class="form-control input-md"><br>
      
          
           <!-- Input date -->
      <input id="date" name="dates_r" type="date" placeholder=" Date" class="form-control input-md"><br>
        
            <!-- Input description-->
        <div class="col-md-12">
        <textarea id="description" name="description_r" type="text" placeholder="Description" class="form-control input-md col-md-12"></textarea><br>
         <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
        <script>CKEDITOR.replace( 'description_r' ) </script>
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
   
   
    
         
         
          

  

