<?php
    session_start();
    include_once("database/databaseConnection.php");
    $userId = $_SESSION["userId"];
	if(!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
        echo "<a href='views/login.php'>please log in</a>";
        header("Location: views/login.php");
		exit();
    }
    if (isset($_GET["deleteTask"])) {
        require_once("model/task.php");
        deleteTaskWithId($_GET["deleteTask"]);
    }
    if (isset($_GET["taskId"])) {
        $taskId = $_GET["taskId"];
        $taskName = $_POST["taskName"];
        $taskType = $_POST["taskType"];
        $unit = $_POST["unit"];
        require_once("model/task.php");
        saveTask($taskId, $taskName, $taskType, $unit);
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Untere Grenze</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Tempalte CSS -->
    <link href="css/small-business.css" rel="stylesheet">

    <!-- Custom CSS adjustment -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/PP_50.png" type="image/png" />
    <link rel="icon" href="img/PP_50.png" type="image/png" />
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
                <a class="navbar-brand" href="index.php">
                    <img src="img/PP_50.png" alt="" height="50px">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="float: right">
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
                <h1>Planning Poker</h1>
                <a class="btn btn-primary" href="views/startGame.php">Spiel erstellen</a>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->

        <hr />
        
        <h2>Spiele</h2>
        <p>Übersicht über alle Spiele</p>
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Projektleiter</th>
                    <th>Status</th>
                    <th>Ergebnis</th>
                </tr>
                <?php
                    require_once("model/task.php");
                    $theIds = getAllIdsOfTable("task");
                    foreach($theIds AS $eachId) {
                        $taskName = nameOfTaskWithId($eachId);
                        $creatorName = creatorNameOfTaskWithId($eachId);
                        $statusName = statusNameForTaskWithId($eachId);
                        if (isOpen($eachId)) {
                            $result = "-";
                        } else {
                            $result = resultOfTaskWithId($eachId);
                        }
                        echo "<tr onclick=\"window.document.location='#'\">
                            <td><a href='views/startGame.php?taskId=$eachId'>$taskName</a></td>
                            <td>$creatorName</td>
                            <td>$statusName</td>
                            <td>$result</td>
                        </tr>";
                    }
                ?>
            </table>
            <!-- /.col-md-4 -->
        <!-- /.row -->
        <h2>Offene Votes</h2>
        <p>Spiele bei denen Sie Ihr Votum abgeben können</p>
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Projektleiter</th>
            </tr>
            <?php
                require_once("model/user.php");
                require_once("model/invitation.php");
                $theIds = allInvitationIdsForUserWithId($userId);
                foreach ($theIds AS $eachId) {
                    $eachTaskId = taskIdOfInivitationWithId($eachId);
                    $taskName = taskNameOfInivitationWithId($eachId);
                    $creatorName = creatorNameOfInvitationWithId($eachId);
                    if (isOpen($eachTaskId)) {
                        echo "<tr>
                            <td><a href='views/startGame.php?taskId=$eachTaskId'>$taskName</a></td>
                            <td>$creatorName</td>
                        </tr>";
                    }
                }
            ?>
        </table>


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