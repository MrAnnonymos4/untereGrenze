<?php
function connectDb() {
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "PlanningPoker";

<<<<<<< HEAD
// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connection->connect_error) {
echo "error";
die("Connection failed: " . $connection->connect_error);
}
return $connection;
}
=======
    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($connection->connect_error) {
        echo "error";
        die("Connection failed: " . $connection->connect_error);
    }
>>>>>>> dbde02583b08b00f1338e17428aa09aeffabfe85
?>