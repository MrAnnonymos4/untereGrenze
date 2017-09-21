<?php

	function connec
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "aktien";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
?>