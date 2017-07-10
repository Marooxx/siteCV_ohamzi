<?php require '../connexion/connexion.php' ?>
<?php
// GEstion du contenu
// insertion d'une competences
//gestion des contenus
	//insertion d'une expérience
		if(isset($_POST['titre_e'])){//si on récupère une nouvelle expérience
			if($_POST['titre_e']!='' && $_POST['description_e']!='' && $_POST['dates_e']!=''){// si expérience et les autres champs ne sont pas vide
				$titre_e = addslashes($_POST['titre_e']);
				$sous_titre_e = addslashes($_POST['sous_titre_e']);
            	$description_e = addslashes($_POST['description_e']);
            	$dates_e = addslashes($_POST['dates_e']);

				$pdocv->exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_e', '$sous_titre_e', '$description_e', '$dates_e', '$id_utilisateur') ");//mettre $id_utilisateur quand on l'aura en variable de session
				header("location: ../admin/experience.php");
				exit();
			}//ferme le if
		}//ferme le if isset

	//suppression d'une expérience
		if(isset($_GET['id_experience'])){
			$eraser= $_GET['id_experience'];
			$sql = " DELETE FROM t_experiences WHERE id_experience = '$eraser' ";
			$pdocv -> query($sql);// ou on peut avec exec
			header("location: ../admin/experience.php");
		}

	?>
//****************** SUPPRESSION D'UNE COMPETENCE ************************
if (isset($_GET['id_competence'])) {
    $eraser = $_GET['id_competence'];
    $sql = "DELETE FROM t_competences WHERE id_competence = '$eraser'";
    $pdocv->query($sql); // ou on peut avec "exec"
    header("location:../admin/competence.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<?php
$sql = $pdocv->query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1' ");
$ligne_utilisateur = $sql->fetch();// va chercher information
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin <?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom'];?></title>

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

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom'];?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom'];?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom'];?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="charts.php"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                     <li>
                        <a href="competence.php"><i class="fa fa-fw fa-edit"></i> Compétences</a>
                    </li>
                     <li>
                        <a href="experience.php"><i class="fa fa-fw fa-edit"></i> Expériences</a>
                    </li> 
                    <li>
                        <a href="loisir.php"><i class="fa fa-fw fa-edit"></i> Loisirs</a>
                    </li>
                    <li class="active">
                        <a href="tables.php"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li>
                        <a href="forms.php"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>

                    <li>
                        <a href="bootstrap-elements.php"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li>
                        <a href="bootstrap-grid.php"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#"></a>
                            </li>
                            <li>
                                <a href="#"></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blank-page.php"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>
                    <li>
                        <a href="index-rtl.php"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <?php
                    $experience = $pdocv->prepare("SELECT * FROM t_experiences WHERE utilisateur_id = '1' ORDER BY experience ASC ");
                    $experience->execute();// execute la
                    $nbr_experiences = $experience->rowCount();
                ?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">EXPERIENCES</h1>
                        <p> Il y a <?php echo $nbr_experiences; ?> expériences de la table pour <?php echo $ligne_utilisateur['pseudo']; ?> </p>


                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> EXPERIENCES
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
                                        <th>Expériences</th>
                                        <th>Entreprise</th>
                                        <th>Date</th>
                                        <th>Descriptif</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    <tr>
                                        <?php while ($ligne_experience = $experience->fetch()) { ?>
                                        <td><?php echo $ligne_experience['titre_e']; ?></td>
                                        <td><?php echo $ligne_experience['sous_titre_e']; ?></td>
                                        <td><?php echo $ligne_experience['date']; ?></td>
                                        <td><?php echo $ligne_experience['description']; ?></td>
                                        
                                        <td><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience'];?>"><span class="glyphicon glyphicon-wrench pull-right"></span></a></td>
                                        <td><a href="experience.php?id_experience=<?php echo $ligne_experience['id_experience'];?>"><span class="glyphicon glyphicon-trash pull-right"></span></a></td>
                                    </tr>
                                         <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
 <div class="row">
    <form class="form-horizontal" method="post" action="experience.php">
    <fieldset>

    <!-- FOrmulaire des expériences -->
    <legend style="text-align:center;"> Ajout d'une expérience</legend>

    <!-- Text input-->
    <div class="form-group">
      
        <label class="col-md-4 control-label" for="experience"></label>
      <div class="col-md-4"><br>
      <input id="experience" name="experience" type="text" placeholder="insérez une expérience" class="form-control input-md"><br>
      
          <label class="col-md-6 control-label" for="entreprise"></label>
      <div class="col-md-7"><br>
      <input id="entreprise" name="entreprise" type="text" placeholder="insérez l'entreprise" class="form-control input-md"><br>
      
          <label class="col-md-6 control-label" for="date"></label>
      <input id="date" name="date" type="date" placeholder="insérez une date" class="form-control input-md"><br>
        
          <label class="col-md-6 control-label" for="description"></label>
        <textarea id="description" name="description" type="text" placeholder="description" class="form-control input-md"></textarea><br>

            <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="button"></label>
      <div class="col-md-4">
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
    <script src="js/monjs.js"></script>
</body>

</html>
