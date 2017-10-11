<?php
    session_start();
    //returns true when put into an if()

    echo "<p>Session-Content: ";
    print_r($_SESSION);
    echo "</p>";
    $_SESSION['id'] = "success";//user ID read from databse
    echo $_SESSION['id']; //prints out the ID just fine.
?>