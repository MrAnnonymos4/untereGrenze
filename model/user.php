<?php
    function checkUserMailAndPassword($anEmail, $aPassword) {
        include_once("../database/databaseConnection.php");
        $sql = "SELECT id FROM user WHERE email = '$anEmail' AND password = '$aPassword'";
        $connection = connectDb();
        $queryResult = $connection->query($sql);
        if ($queryResult->num_rows == 1) {
            while($row = $queryResult->fetch_assoc()) {
                $result = $row["id"];
            }
        } else {
            $result = -1;
        }
        return $result;
    }

    function nameOfUserWithId($userId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("name", $userId, "user");
    }
?>