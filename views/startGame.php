<!DOCTYPE html>
<html lang="de">
    <?php
        session_start();
        include_once("../database/databaseConnection.php");
        include_once("../model/task.php");
        $taskId = $_GET["taskId"];
        if(!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
            header("Location: login.php");
            echo "<a href='login.php'>Weiterleitung hat nicht funktioniert</a>";
            exit();        
        }
        $userId = $_SESSION['userId'];
        if (!isset($taskId)) {
            $taskId = addTask("Neuer Task", $userId);
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
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="task.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
                    <a class="navbar-brand" href="../">
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
        
            <div>
                <hr />
                <form action="../index.php?taskId=<?php echo $taskId?>" method="post">
                    <div class="form-group">
                        <label for="taskName">Name des Spiels</label>
                        <?php
                            $taskName = nameOfTaskWithId($taskId);
                            echo "<input type='text' class='form-control' id='game' name='taskName' value='$taskName'>";
                        ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="sel1">Spieltyp:</label>
                        <select class="form-control" id="gametype" name="taskType">
                            <?php
                                $theIds = getAllIdsOfTable("taskType");
                                require_once("../model/taskType.php");
                                $typeId = typeIdOfTaskWithId($taskId);
                                foreach ($theIds AS $eachId) {
                                    $typeName = nameOfTaskTypeWithId($eachId);
                                    if ($eachId == $typeId) {
                                        echo "<option value='$eachId' selected>$typeName</option>";
                                    } else {
                                        echo "<option value='$eachId'>$typeName</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <?php
                            $theIds = getAllIdsOfTable("unit");
                            require_once("../model/unit.php");
                            $unitId = unitIdOfTaskWithId($taskId);
                            foreach($theIds AS $eachId) {
                                $unitName = nameOfUnitWithId($eachId);
                                if ($unitId == $eachId) {
                                    echo "<label class='radio-inline'><input type='radio' name='unit' value='$eachId' checked='checked'>$unitName</label>";
                                } else {
                                    echo "<label class='radio-inline'><input type='radio' name='unit' value='$eachId'>$unitName</label>";
                                }
                                
                            }
                        ?>
                    </div>
                    <h2>Teilnehmer</h2>
                    <p>Folgende Spieler können Sie einladen:</p>
                    <table id="table" class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <?php
                                    if (isset($taskId)) {
                                        echo "<th>Status/Vote</th>";
                                    } else {
                                        echo "<th>Aktion</th>";
                                    }
                                ?>
                            </tr>
                            <?php
                                
                                $theIds = getAllIdsOfTable("user");
                                require_once("../model/user.php");
                                foreach($theIds AS $eachId) {
                                    echo "<tr>";
                                    $name = nameOfUserWithId($eachId);
                                    $mail = mailOfUserWithId($eachId);
                                    echo "<td>$name</td><td>$mail</td>";
                                    if (existInvitationForUserIdAndTaskId($eachId, $taskId)) {
                                        $vote = invitationVoteForUserIdAndTaskId($eachId, $taskId);
                                        if ($vote >= 0) {
                                            echo "<td>$vote</td>";
                                        } else {
                                            if ($eachId == $userId) {
                                                echo "<td>
                                                        <form><input type='number' style='width: 75px'/></form>
                                                        <button class='btn btn-info' href='#'>Vote abgeben</button>
                                                    </td>";
                                            } else {
                                                echo "<td>eingeladen</td>";
                                            }     
                                        }
                                        
                                    } else {
                                        $ownerId = creatorIdOfTaskWithId($taskId);
                                        if ($ownerId == $userId) {
                                            echo "<td><button id='inviteButton$eachId' class='btn btn-success' onclick='sendInvitation($taskId, $eachId);' type='button'>Einladen</button></td>";
                                        } elseif ($ownerId == $eachId){ 
                                            echo "<td>Inhaber</td>";
                                        }
                                        else {
                                            echo "<td>nicht eingeladen</td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <div style="padding: 5px">
                        <?php
                            if (creatorIdOfTaskWithId($taskId) == $userId) {
                                echo "<button type='submit' class='btn btn-primary'>Speichern!</button>";
                                echo "<a type='submit' class='btn btn-danger' href='../index.php?deleteTask=$taskId'>Löschen!</a>";
                            }
                            $invitationVote = invitationVoteForUserIdAndTaskId($userId, $taskId);
                            if (existInvitationForUserIdAndTaskId($userId, $taskId)  && invitationVoteForUserIdAndTaskId($userId, $taskId) == -1) {
                                echo "<button type='button' class='btn btn-info'>Abstimmen!</button>";
                            }
                        ?>
                    </div>
                </div>
            </form>
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
