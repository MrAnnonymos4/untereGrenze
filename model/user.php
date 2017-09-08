<?php
    function checkUserMailAndPassword($anEmail, $aPassword) {
        include("../database/databaseConnection.php");
        $sql = "SELECT id FROM user WHERE email = '$anEmail' AND password = '$aPassword'";
        $queryResult = $connection->query($sql);
        if ($queryResult->num_rows == 1) {
            while($row = $queryResult->fetch_assoc()) {
                $result = $row["id"];
            }
        } else {
            $result = -1;

        }
        $connection->close();
        return $result;
    }
?>