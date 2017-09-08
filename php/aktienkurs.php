<?php
    include("database.php");
    $name = $_GET["player"];

    $deltaValue = rand(1,15) / 100;


    $sql = "SELECT value FROM kurslog WHERE playerName = '$name' ORDER BY timestamp DESC";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $oldValue =  $row["value"];
            $increasingProp = 0.5;
            if (rand(0, 1) < $increasingProp) {
                $newValue = $oldValue + $deltaValue;
            } else {
                $newValue = $oldValue - $deltaValue;
            }
            break;
        }
    } else {
        $newValue = 100;
    }




    $sql = "INSERT INTO kurslog(value, playerName) VALUES ($newValue, '$name')";
    $result = $connection->query($sql);
    $connection->close();
    
    
    echo $newValue

?>