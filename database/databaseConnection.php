<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "PlanningPoker";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($connection->connect_error) {
        echo "error";
        die("Connection failed: " . $connection->connect_error);
    }
?>