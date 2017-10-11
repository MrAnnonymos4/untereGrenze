﻿<!DOCTYPE html>
<html lang="de">

<?php
	session_start();
	if(!isset($_SESSION['userId']) || !empty($_SESSION['userId'])) {
		header("Location: views/login.php");
		die();
	}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Untere Grenze</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/small-business.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="img/unteregrenze.png" alt="" height="50px">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Angefangene Spiele</a>
                    </li>
                    
                    <li>
                        <a href="#">Einladungen</a>
                    </li>
                    
                    <li>
                        <a href="#">Abgeschlossene Spiele</a>
                    </li>
                    
                    <li><a class="btn btn-default" href="loggedOut.php">Abmelden</a></li>
                    

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Heading Row -->
        <div class="row">
            <!-- /.col-md-8 -->
            <div class="col-md-12">
                <h1>Planning Poker Nerds</h1>
                <p>Dies ist das Planning Poker vong dem krassen Nerds, leider kann nur einer vong ums Programmieren. Deutsch ist auch nicht unsere Stärk, mehr so Vong Spracke.</p>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
	</div>
	<div class="container">
        <hr>
        <!-- Content Row -->
        <div class="row">
        <h2>Ihre Angefangenen Spiele</h2>
        <p>Hier können Sie die Spiele sehen die sie bereits angenommen haben, aber welche noch nicht abgeschlossen sind.</p>
            <table id="table" class="table table-striped">
                	<tr>
                		<th>Name</th>
                		<th>Projektleiter</th>
                		<th>Datum</th>
                		<th>Status</th>
                	</tr>
                
                </table>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
                <div class="row">
        <h2>Ihre Einladungen:</h2>
        <p>Das ist die Tabelle die Ihnen anzeigt welche Spieler sie eingeladen haben.</p>
            <table id="table" class="table table-striped">
                	<tr>
                		<th>Name</th>
                		<th>Projektleiter</th>
                		<th>Datum</th>
                		<th>Zusagen</th>
                		<th>Absagen</th>
                	</tr>
                
                </table>
</div>
        <!-- /.row -->
                <div class="row">
        <h2>Ihre Abgeschlossenen Spiele:</h2>
        <p>Diese Tabelle zeigt Ihnen welche Spiele sie bereits abgeschlossen haben, und welches Ergebnis jeweils dabei herauskam.</p>
            <table id="table" class="table table-striped">
                	<tr>
                		<th>Name</th>
                		<th>Projektleiter</th>
                		<th>Datum</th>
                		<th>Wert</th>
                		<th>Einheit</th>
                	</tr>
                	
                </table>
            <!-- /.col-md-4 -->
        </div>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Niklas, Simon, Erik, Sharmili und Nicolas 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>