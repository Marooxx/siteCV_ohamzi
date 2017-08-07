<?php require 'connexion/connexion.php' ?>

<!--  Requête pour rendre les jauges de compétences dynamiques -->
<?php
$sql = $pdocv->query("SELECT * FROM t_competences WHERE utilisateur_id = '1' ");
//var_dump($sql);
$ligne_competence = $sql->fetchAll();// va chercher information
?>




<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Requête d'affichage dynamique du Prénom et Nom  -->
    <?php
    $sql = $pdocv->query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1' ");
    $ligne_utilisateur = $sql->fetch();// va chercher information
    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Omar HAMZI</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link id="css-preset" href="css/presets/preset1.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="dist/jquery.timeliny.css" rel="stylesheet">
    <link rel="stylesheet" href="css/timeline.css">
    <link rel="stylesheet" href="css/mystyle.css">


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="images/favicon.ico">
</head><!--/head-->

<body>

    <!--.preloader-->
    <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
    <!--/.preloader-->

    <header id="home">
        <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active" style="background-image: url(images/slider/1.jpg)">
                    <div class="caption">
                        <h1 class="animated fadeInLeftBig"> <?php echo $ligne_utilisateur['prenom'] ?><span><?php echo $ligne_utilisateur['nom'];?></span></h1>
                        <p class="animated fadeInRightBig">Développeur Intégrateur Web Junior</p>
                        <a data-scroll class="btn btn-start animated fadeInUpBig" href="#services">Start now</a>
                    </div>
                </div>

            </div>
            <!--<a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
            <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>-->

            <a id="tohash" href="#services"><i class="fa fa-angle-down"></i></a>

        </div><!--/#home-slider-->
        <div class="main-nav" style="background-color:#4584b7;">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <h1><img class="img-responsive" src="" alt=""></h1>
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="scroll active"><a href="#home">Accueil</a></li>
                        <li class="scroll"><a href="#about-us">Compétences</a></li>
                        <li class="scroll"><a href="#team">Expériences et formations</a></li>
                        <li class="scroll"><a href="#services">Mes Atouts</a></li>
                        <li class="scroll"><a href="#blog">Loisirs</a></li>
                        <li class="scroll"><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div><!--/#main-nav-->
    </header><!--/#home-->





                    <!--******************************* Compétences ************************************************ -->
    <section id="about-us" class="parallax" style="
    margin-top: 53px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="about-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <h2>Mes Compétences</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.Ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <!-- Mes Compétences  -->
                <div class="col-sm-6">
                    <div class="our-skills wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >
                        <?php foreach ($ligne_competence as $jauge ): ?>
                            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <p class="lead"><?= $jauge['competence'] ?></p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="<?= $jauge['niveau'] ?>"><?= $jauge['niveau'] ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#Compétences-->






            <!-- ***********************************REALISATIONS******************************************  -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms" >
                    <h2> Réalisations</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam</p>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="folio-image">
                            <img class="img-responsive" src="images/portfolio/1.jpg" alt="">
                        </div>
                        <div class="overlay">
                            <div class="overlay-content">
                                <div class="overlay-text">
                                    <div class="folio-info">
                                        <h3>Time Hours</h3>
                                        <p>Design, Photography</p>
                                    </div>
                                    <div class="folio-overview">
                                        <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                                        <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="folio-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="400ms">
                        <div class="folio-image">
                            <img class="img-responsive" src="images/portfolio/2.jpg" alt="">
                        </div>
                        <div class="overlay">
                            <div class="overlay-content">
                                <div class="overlay-text">
                                    <div class="folio-info">
                                        <h3>Time Hours</h3>
                                        <p>Design, Photography</p>
                                    </div>
                                    <div class="folio-overview">
                                        <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                                        <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="500ms">
                        <div class="folio-image">
                            <img class="img-responsive" src="images/portfolio/3.jpg" alt="">
                        </div>
                        <div class="overlay">
                            <div class="overlay-content">
                                <div class="overlay-text">
                                    <div class="folio-info">
                                        <h3>Time Hours</h3>
                                        <p>Design, Photography</p>
                                    </div>
                                    <div class="folio-overview">
                                        <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                                        <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="folio-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="folio-image">
                            <img class="img-responsive" src="images/portfolio/4.jpg" alt="">
                        </div>
                        <div class="overlay">
                            <div class="overlay-content">
                                <div class="overlay-text">
                                    <div class="folio-info">
                                        <h3>Time Hours</h3>
                                        <p>Design, Photography</p>
                                    </div>
                                    <div class="folio-overview">
                                        <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                                        <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="700ms">
                        <div class="folio-image">
                            <img class="img-responsive" src="images/portfolio/5.jpg" alt="">
                        </div>
                        <div class="overlay">
                            <div class="overlay-content">
                                <div class="overlay-text">
                                    <div class="folio-info">
                                        <h3>Time Hours</h3>
                                        <p>Design, Photography</p>
                                    </div>
                                    <div class="folio-overview">
                                        <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                                        <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="folio-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="800ms">
                        <div class="folio-image">
                            <img class="img-responsive" src="images/portfolio/6.jpg" alt="">
                        </div>
                        <div class="overlay">
                            <div class="overlay-content">
                                <div class="overlay-text">
                                    <div class="folio-info">
                                        <h3>Time Hours</h3>
                                        <p>Design, Photography</p>
                                    </div>
                                    <div class="folio-overview">
                                        <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                                        <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="900ms">
                        <div class="folio-image">
                            <img class="img-responsive" src="images/portfolio/7.jpg" alt="">
                        </div>
                        <div class="overlay">
                            <div class="overlay-content">
                                <div class="overlay-text">
                                    <div class="folio-info">
                                        <h3>Time Hours</h3>
                                        <p>Design, Photography</p>
                                    </div>
                                    <div class="folio-overview">
                                        <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                                        <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="folio-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="1000ms">
                        <div class="folio-image">
                            <img class="img-responsive" src="images/portfolio/8.jpg" alt="">
                        </div>
                        <div class="overlay">
                            <div class="overlay-content">
                                <div class="overlay-text">
                                    <div class="folio-info">
                                        <h3>Time Hours</h3>
                                        <p>Design, Photography</p>
                                    </div>
                                    <div class="folio-overview">
                                        <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                                        <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="portfolio-single-wrap">
            <div id="portfolio-single">
            </div>
        </div><!-- /#portfolio-single-wrap -->
    </section><!--/#Réalisations-->




              <!--************************************ Expérience et formations ************************************* -->
    <section id="team">
        <div class="container">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms" style="margin-top:186px">
                    <h2>Expériences et Formations</h2>


                </div>
            </div>
            <!-- ####### Timeline ############   -->

    <section class="timeline">
      <ul>
        <li>
          <div>
            <time>1934</time> At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
          </div>
        </li>
        <li>
          <div>
            <time>1937</time> Proin quam velit, efficitur vel neque vitae, rhoncus commodo mi. Suspendisse finibus mauris et bibendum molestie. Aenean ex augue, varius et pulvinar in, pretium non nisi.
          </div>
        </li>
        <li>
          <div>
            <time>1940</time> Proin iaculis, nibh eget efficitur varius, libero tellus porta dolor, at pulvinar tortor ex eget ligula. Integer eu dapibus arcu, sit amet sollicitudin eros.
          </div>
        </li>
        <li>
          <div>
            <time>1943</time> In mattis elit vitae odio posuere, nec maximus massa varius. Suspendisse varius volutpat mattis. Vestibulum id magna est.
          </div>
        </li>
        <li>
          <div>
            <time>1946</time> In mattis elit vitae odio posuere, nec maximus massa varius. Suspendisse varius volutpat mattis. Vestibulum id magna est.
          </div>
        </li>
        <li>
          <div>
            <time>1956</time> In mattis elit vitae odio posuere, nec maximus massa varius. Suspendisse varius volutpat mattis. Vestibulum id magna est.
          </div>
        </li>
        <li>
          <div>
            <time>1957</time> In mattis elit vitae odio posuere, nec maximus massa varius. Suspendisse varius volutpat mattis. Vestibulum id magna est.
          </div>
        </li>
        <li>
          <div>
            <time>1967</time> Aenean condimentum odio a bibendum rhoncus. Ut mauris felis, volutpat eget porta faucibus, euismod quis ante.
          </div>
        </li>
        <li>
          <div>
            <time>1977</time> Vestibulum porttitor lorem sed pharetra dignissim. Nulla maximus, dui a tristique iaculis, quam dolor convallis enim, non dignissim ligula ipsum a turpis.
          </div>
        </li>
        <li>
          <div>
            <time>1985</time> In mattis elit vitae odio posuere, nec maximus massa varius. Suspendisse varius volutpat mattis. Vestibulum id magna est.
          </div>
        </li>
        <li>
          <div>
            <time>2000</time> In mattis elit vitae odio posuere, nec maximus massa varius. Suspendisse varius volutpat mattis. Vestibulum id magna est.
          </div>
        </li>
        <li>
          <div>
            <time>2005</time> In mattis elit vitae odio posuere, nec maximus massa varius. Suspendisse varius volutpat mattis. Vestibulum id magna est.
          </div>
        </li>
      </ul>
      <!-- #/Timeline  -->
    </section>
    <!-- #/Expériences et formations -->



            <!--*********************************** Atouts ****************************************  -->
            <section id="services" >
                <div class="container" style="background-image:../images/fond2.jpg;">
                    <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="row">
                            <div class="text-center col-sm-8 col-sm-offset-2">
                                <h2>Mes Atouts</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center our-services">
                        <div class="row">
                            <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <div class="service-icon">
                                    <i class="fa fa-flask"></i>
                                </div>
                                <div class="service-info">
                                    <h3>Brand Identity</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="450ms">
                                <div class="service-icon">
                                    <i class="fa fa-umbrella"></i>
                                </div>
                                <div class="service-info">
                                    <h3>Creative Idea</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="550ms">
                                <div class="service-icon">
                                    <i class="fa fa-cloud"></i>
                                </div>
                                <div class="service-info">
                                    <h3>Awesome Support</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="650ms">
                                <div class="service-icon">
                                    <i class="fa fa-coffee"></i>
                                </div>
                                <div class="service-info">
                                    <h3>Professional Design</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="750ms">
                                <div class="service-icon">
                                    <i class="fa fa-bitbucket"></i>
                                </div>
                                <div class="service-info">
                                    <h3>App Development</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="850ms">
                                <div class="service-icon">
                                    <i class="fa fa-gift"></i>
                                </div>
                                <div class="service-info">
                                    <h3>Clean Code</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/#Atouts-->

            <section id="blog">
                <div class="container">
                    <div class="row">
                        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
                            <h2>Centre d'intérêts</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam</p>
                        </div>
                    </div>
                    <div class="blog-posts">
                        <div class="row">
                            <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
                                <div class="post-thumb">
                                    <a href="#"><img class="img-responsive" src="images/blog/1.jpg" alt=""></a>
                                    <div class="post-meta">
                                        <span><i class="fa fa-comments-o"></i> 3 Comments</span>
                                        <span><i class="fa fa-heart"></i> 0 Likes</span>
                                    </div>
                                    <div class="post-icon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                                <div class="entry-header">
                                    <h3><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit</a></h3>
                                    <span class="date">June 26, 2014</span>
                                    <span class="cetagory">in <strong>Photography</strong></span>
                                </div>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                                <div class="post-thumb">
                                    <div id="post-carousel"  class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#post-carousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#post-carousel" data-slide-to="1"></li>
                                            <li data-target="#post-carousel" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <a href="#"><img class="img-responsive" src="images/blog/2.jpg" alt=""></a>
                                            </div>
                                            <div class="item">
                                                <a href="#"><img class="img-responsive" src="images/blog/1.jpg" alt=""></a>
                                            </div>
                                            <div class="item">
                                                <a href="#"><img class="img-responsive" src="images/blog/3.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <a class="blog-left-control" href="#post-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                        <a class="blog-right-control" href="#post-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                    <div class="post-meta">
                                        <span><i class="fa fa-comments-o"></i> 3 Comments</span>
                                        <span><i class="fa fa-heart"></i> 0 Likes</span>
                                    </div>
                                    <div class="post-icon">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                </div>
                                <div class="entry-header">
                                    <h3><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit</a></h3>
                                    <span class="date">June 26, 2014</span>
                                    <span class="cetagory">in <strong>Photography</strong></span>
                                </div>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="800ms">
                                <div class="post-thumb">
                                    <a href="#"><img class="img-responsive" src="images/blog/3.jpg" alt=""></a>
                                    <div class="post-meta">
                                        <span><i class="fa fa-comments-o"></i> 3 Comments</span>
                                        <span><i class="fa fa-heart"></i> 0 Likes</span>
                                    </div>
                                    <div class="post-icon">
                                        <i class="fa fa-video-camera"></i>
                                    </div>
                                </div>
                                <div class="entry-header">
                                    <h3><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit</a></h3>
                                    <span class="date">June 26, 2014</span>
                                    <span class="cetagory">in <strong>Photography</strong></span>
                                </div>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section><!--/#blog-->

            <section id="contact">

                <div id="contact-us" class="parallax">
                    <div class="container">
                        <div class="row">
                            <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <h2>Contactez moi</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam</p>
                            </div>
                        </div>
                        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form id="main-contact-form" name="contact-form" method="post" action="#">
                                        <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" placeholder="Name" required="required">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="subject" class="form-control" placeholder="Subject" required="required">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter your message" required="required"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn-submit">Send Now</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <div class="contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                        <ul class="address">
                                            <li><i class="fa fa-map-marker"></i> <span> Address:</span> 43 avenue du Président Wilson - 93210 La Plaine Saint-Denis </li>
                                            <li><i class="fa fa-phone"></i> <span> Phone:</span> 06.38.01.24.98 </li>
                                            <li><i class="fa fa-envelope"></i> <span> Email:</span><a href="mailto:omarhamzi40@gmail.com"> omarhamzi40@gmail.com</a></li>
                                            <li><i class="fa fa-globe"></i> <span> Website:</span> <a href="#">www.sitename.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/#contact-->
            <footer id="footer">
                <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <div class="container text-center">
                        <div class="footer-logo">
                            <a href="index.php"><img class="img-responsive" src="" alt=""></a>
                        </div>
                        <div class="social-icons">
                            <ul>
                                <li><a class="envelope" href="#"><i class="fa fa-envelope"></i></a></li>
                                <li><a class="github" href="#"><i class="fa fa-github"></i></a></li>
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>&copy; 2017- Omar HAMZI</p>
                            </div>
                            <div class="col-sm-6">
                                <!-- <p class="pull-right">Designed by <a href="http://www.themeum.com/">Themeum</a></p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
            <script type="text/javascript" src="js/jquery.inview.min.js"></script>
            <script type="text/javascript" src="js/wow.min.js"></script>
            <script type="text/javascript" src="js/mousescroll.js"></script>
            <script type="text/javascript" src="js/smoothscroll.js"></script>
            <script type="text/javascript" src="js/jquery.countTo.js"></script>
            <script type="text/javascript" src="js/lightbox.min.js"></script>
            <script type="text/javascript" src="js/main.js"></script>
            <!-- <script type="text/javascript" src="js/timeline.js"></script> -->
            <script src="//code.jquery.com/jquery-latest.min.js"></script>
            <script src="dist/jquery.timeliny.js"></script>
            <script type="text/javascript" src="js/timeline.js">

            </script>

        </body>
        </html>
