<?php 
// Initialize the session. 
session_start(); 

// Unset all of the session variables. 
$_SESSION = array(); 

// Finally, destroy the session. 
session_destroy(); 
?>

<!DOCTYPE html>
<html lang="en">
    <head></head>
    <body><p>Abgemeldet</p></body>
</html>