<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
		<meta name="author" content="Martin Vicián">
		<meta name="theme-color" content="#2c3e50">

    <title>Mozart Dice Game</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <link href="css/mozart.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">
<a href="https://github.com/vician/mozart-game"><img style="position: absolute; top: 60px; right: 0; border: 0;" src="https://camo.githubusercontent.com/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png"></a>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-shrink">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Mozart Dice Game</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#game">Game</a>
                    </li>
                    <?php /*<li class="page-scroll">
                        <a href="#loop">Loop</a>
                    </li>*/?>
                    <li class="page-scroll">
                        <a href="#about">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#demo">Demo</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <section id="game">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Generate song:<br>
                    <div id="type" class="btn-group btn-toggle">
                        <button class="btn btn-default active">Minuet</button>
                        <button class="btn btn-primary">Trio</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-group" style="margin-top: 10px; margin-bottom: 10px;">
                      <button class="btn btn-default" id="song_play" onclick="song_play(0);" disabled="true">Play song</button>
                      <button class="btn btn-default" id="song_stop" onclick="song_stop();" disabled="true">Stop song</button>

                      <button class="btn btn-default" onclick="song_generate();">Generate another song</button>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                    <div style="display: none;">Song: <input class="btn" type="text" id="song" size="20" readonly="true"><br></div>
                    <div style="btn-group btn-group-xs">
                      <audio id="player">Your browser does not support the audio element.</audio>
                    </div>
                    <div id="players">Your browser does not support JavaScript.</div>
                    <!--<button id="preload" onclick="preload();">Preload</button><br>-->
										<?php if(isset($_GET['demo'])) { ?> <div id="playOnly8">Demo playing..</div> <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <div id="minuets"></div>
                        <div id="trios"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php /*<section class="success" id="loop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Loop</h2>
                    <!--<hr class="star-light">-->
										Is preparing...
                </div>
            </div>

        </div>
    </section>*/?>

    <!-- Contact Section -->
    <section id="about" class="success">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <!--<hr class="star-primary">-->
<div style="text-align: left;">
An interesting musical game, Musikalisches Würfelspiel (musical dice game) has often been attributed to Mozart.<br>
<br>
The basis of the musical dice game consists of 272 musical measures and a table of rules used to select specific measures given a certain dice roll.  The result is a randomly selected 16 bar minuet and 16 bar trio.<br>
<br>
The famous version of the dice game attributed to Mozart, was first published only after his death in 1793 by J.J. Hummel in Berlin-Amsterdam, and afterwards several times in different forms. While this challenging idea had been known and tried out by other composers before Mozart, it was Mozart's game which became famous and successful. Though neither the original manuscript of the "Musikalisches Würfelspiel" nor direct references to it by Mozart were ever found, his authorship was never really questioned by publishers or musicologists.<br>
<br>
A game with identical musical sections was described in the February 1787 issue of a publications called Journal des Luxus und der Moden (Journal of Luxury and Fashions!). W. A. Mozart may have been connected with or influenced by this publication.... the later dice game attributed to him contains a rule table which is identical to the minuet table in the publication.. <br>
<br>
All possible choices were given by Mozart in such a way that by any selection the resulting melody is a pretty minuet fulfilling the harmonic and compositional requirements of minuets of that time.<br><br>
</div>
<div align="right">[<a href="http://www.amaranthpublishing.com/MozartDiceGame.htm">http://www.amaranthpublishing.com/MozartDiceGame.htm</a>]</div>

                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="demo">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Demo</h2>
                    <!--<hr class="star-primary">-->
										<video  width="100%" id="demo" controls onclick=" this.paused ? this.play() : this.pause();">
											<source src="video.webm" type="video/webm">
										</video>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Author</h3>
                        <p><a href="https://www.vician.cz/">Martin Vicián</a></p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Project</h3>
                        <p>
                          <a href="https://is.muni.cz/predmet/fi/podzim2014/PV121">PV121 Computer Music I</a><br />
                          <a href="http://www.fi.muni.cz/~qruzicka">MgA. Rudolf Růžička</a>
                        </p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Sources</h3>
                        <p>
                            <a href="http://www.amaranthpublishing.com/MozartDiceGame.htm">amaranthpublishing.com</a><br />
                            <a href="http://www.sciencenews.org/articles/20010901/mathtrek.asp">sciencenews.org</a><br />
                            <a href="http://www.chr-reuter.de/wuerfel/geschichte.htm">chr-reuter.de</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; <a href="https://www.vician.cz/">Martin Vicián</a> 2014 - <?php echo date("Y"); ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/mozart.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <!--<script src="js/cbpAnimatedHeader.js"></script>-->

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>
