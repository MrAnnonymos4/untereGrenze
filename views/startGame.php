<!DOCTYPE html>
<html lang="de">

<?php
	session_start();
	/*if(!isset($_SESSION['userId']) || !empty($_SESSION['userId'])) {
		header("Location: views/login.php");
		die();
	}
	*/
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Untere Grenze</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/small-business.css" rel="stylesheet">

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
                    <img src="../img/unteregrenze.png" alt="" height="50px">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   
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
                <p>Auf dieser Seite können Sie Ihre Spiele erstellen. Versuchen Sie es:</p>
                <br>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
	
	
	<div class ="col-md-6">
	
	<div class="form-group">
  		<label for="usr">Name des Spiels</label>
  		<input type="text" class="form-control" id="game">
	</div>
	
	 <div class="form-group">
  		<label for="sel1">Spieltyp:</label>
  		<select class="form-control" id="gametype">
    		<option>Mittelwert zwischen größtem und kleinster Wert</option>
    		<option>Project Owner entscheidet</option>
    		<option>Durchschnitt</option>
    		<option>Häufigste Karte</option>
  		</select>
	</div>
	
	<div>
	<label class="radio-inline"><input type="radio" name="einheit">Story Point</label>
	<label class="radio-inline"><input type="radio" name="einheit">Stunden</label>
	<label class="radio-inline"><input type="radio" name="einheit">Tage</label>
	<label class="radio-inline"><input type="radio" name="einheit">Wochen</label>
	<label class="radio-inline"><input type="radio" name="einheit">Monate</label>
	</div>
</div>
		
	<div class="col-md-12">
	
	<h2>Teilnehmer</h2>
	<p>Folgende Spieler können Sie einladen:</p>
	<table id="table" class="table table-striped">
		<tbody>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Status</th>
		</tbody>
	</table>
	
	<button type="button" class="btn btn-primary">Start Game!</button>
	
	</div>
	
		

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                <br>
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
