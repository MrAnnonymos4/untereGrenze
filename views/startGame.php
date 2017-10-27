<!DOCTYPE html>
<html lang="de">
    <?php
        session_start();
        include_once("../database/databaseConnection.php");
        include_once("../model/task.php");
        include_once("../model/invitation.php");
        require_once("../model/user.php");
        require_once("../model/unit.php");
        require_once("../model/taskType.php");
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
        $isOpen = isOpen($taskId);
        $isOwner = creatorIdOfTaskWithId($taskId) == $userId;
        
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

        <!-- Template CSS -->
        <link href="../css/small-business.css" rel="stylesheet">

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
                            $disabledString = "";
                            if (!$isOwner) {
                                $disabledString = "disabled";
                            }
                            $taskName = nameOfTaskWithId($taskId);
                            echo "<input type='text' class='form-control' id='game' name='taskName' value='$taskName' $disabledString>";
                        ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="gametype">Spieltyp:</label>
                        <select class="form-control" id="gametype" name="taskType">
                            <?php
                                $theIds = getAllIdsOfTable("taskType");
                                
                                $typeId = typeIdOfTaskWithId($taskId);
                                foreach ($theIds AS $eachId) {
                                    $typeName = nameOfTaskTypeWithId($eachId);
                                    if ($eachId == $typeId) {
                                        echo "<option value='$eachId' selected $disabledString>$typeName</option>";
                                    } else {
                                        echo "<option value='$eachId' $disabledString>$typeName</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php
                            $theIds = getAllIdsOfTable("unit");
                            $unitId = unitIdOfTaskWithId($taskId);
                            foreach($theIds AS $eachId) {
                                $unitName = nameOfUnitWithId($eachId);
                                if ($unitId == $eachId) {
                                    echo "<label class='radio-inline'><input type='radio' name='unit' value='$eachId' checked='checked' $disabledString>$unitName</label>";
                                } else {
                                    echo "<label class='radio-inline'><input type='radio' name='unit' value='$eachId' $disabledString>$unitName</label>";
                                }   
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            if (!isOpen($taskId)) {
                                $result = resultOfTaskWithId($taskId);
                                echo "<p><strong>Ergebnis:</strong> $result</p>";
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
                                
                                foreach($theIds AS $eachId) {
                                    echo "<tr>";
                                    $name = nameOfUserWithId($eachId);
                                    $mail = mailOfUserWithId($eachId);
                                    echo "<td>$name</td><td>$mail</td>";
                                    if (existInvitationForUserIdAndTaskId($eachId, $taskId)) {
                                        $invitationId = invitationForUserIdAndTaskId($eachId, $taskId);
                                        $vote = voteForInvitationWithId($invitationId);
                                        if ($vote < 0) {
                                            $vote = "";
                                        }
                                        if ($eachId == $userId) {
                                            if ($isOpen) {
                                                echo "<td>
                                                    <form><input type='number' id='voteInput' value='$vote' style='width: 75px'/></form>
                                                    <button class='btn btn-info' onclick='setVote($invitationId)' type='button'>Vote abgeben</button>
                                                </td>";
                                            } else {
                                                echo "<td>Vote: $vote</td>";
                                            }
                                        } else {
                                            echo "<td>Vote: $vote</td>";
                                        }
                                        
                                    } else {
                                        $ownerId = creatorIdOfTaskWithId($taskId);
                                        if ($isOwner && $isOpen) {
                                            echo "<td><button id='inviteButton$eachId' class='btn btn-success' onclick='sendInvitation($taskId, $eachId);' type='button'>Einladen</button></td>";
                                        } elseif ($ownerId == $eachId) {
                                            echo "<td>Ersteller</td>";
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
                    <div>
                        <?php
                            if ($isOwner) {
                                echo "<button type='submit' class='btn btn-primary'>Speichern</button>";
                                echo "<a type='submit' class='btn btn-danger' href='../index.php?deleteTask=$taskId'>Löschen</a>";
                                if ($isOpen) {
                                    echo "<button type='button' class='btn btn-warning' onclick='closeTask($taskId)'>Spiel schließen</button>";
                                }
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
        <script src="../js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

    </body>

</html>
