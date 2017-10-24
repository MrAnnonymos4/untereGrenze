<?php
    connectDb();
    function connectDb() {
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
        return $connection;
    }

    function getConnection() {
        if (!isset($connection)) {
            connectDb();
        }
        return $connection;
    }


    //MySQL-API
    function getAllIdsOfTable($tableName) {
        return getAllIdsOfTableWithCondition($tableName, "true");
    }
    function getAllIdsOfTableWithCondition($tableName, $conditionString) {
        $idArray = array();
        $sql = "SELECT id FROM $tableName WHERE $conditionString";
        $connection = connectDb();
        $queryResult = $connection->query($sql);
        if ($queryResult->num_rows > 0) {
            while($row = $queryResult->fetch_assoc()) {
                array_push($idArray, $row["id"]);
            }
        } else {
            return -1;
        }
        return $idArray;
    }

    function getColumnOfRowWithIdInTable($columnName, $id, $tableName) {
        return getColumnOfRowWithIdInTableWithCondition($columnName, $id, $tableName, "true");
    }   
    function getColumnOfRowWithIdInTableWithCondition($columnName, $id, $tableName, $conditionString) {
        $sql = "SELECT $columnName FROM $tableName WHERE id = '$id' AND $conditionString";
        $queryResult = sendQuery($sql);
        if ($queryResult->num_rows == 1) {
            while($row = $queryResult->fetch_assoc()) {
                $result = $row["$columnName"];
            }
        } else {
            echo $sql;
            $result = "Error: not found";
        }
        return $result;
    }

    function getHighstIdOfTable($tableName) {
        $sql = "SELECT MAX(id) FROM $tableName";
        $result = sendQuery($sql);
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {
                return array_pop($row);
            }
        } 
    }

    function sendQuery($queryString) {
        $connection = connectDb();
        return $connection->query($queryString);
    }

    function delteObjectWithIdFromTable($id, $tableName) {
        $sql = "DELETE FROM $tableName WHERE id = $id";
        sendQuery($sql);
    }
 ?>