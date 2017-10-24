<?php
    function statusNameForTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        
        $theStatusArray = array(
            0 => "angelegt",
            1 => "Einladungen versand",
            2 => "bereit",
            3 => "gestartet",
            4 => "abgeschlossen"
        );
        $theStatusNumber = getColumnOfRowWithIdInTable("status", $taskId, "task");
        return $theStatusArray[$theStatusNumber];
    }
    
    function creatorIdOfTaskWithId($taskId) {
        require_once("user.php");
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("creatorId", $taskId, "task");
    }

    function creatorNameOfTaskWithId($taskId) {
        require_once("user.php");
        $ownerId = creatorIdOfTaskWithId($taskId);
        return nameOfUserWithId($ownerId);
    }

    function nameOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("name",$taskId, "task");
    }

    function typeIdOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("type",$taskId, "task");
    }
    function unitIdOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("unit",$taskId, "task");
    }
    function allInvitationIdsForTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getAllIdsOfTableWithCondition("invitation", "taskId = '$taskId'");
    }




    function addTask($taskName, $userId) {
        include_once("../database/databaseConnection.php");
        $sql = "INSERT INTO task (name, creatorId) VALUES ('$taskName', $userId)";
        sendQuery($sql);
        return getHighstIdOfTable("task");
    }
    function deleteTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        delteObjectWithIdFromTable($taskId, "task");
        foreach (allInvitationIdsForTaskWithId($taskId) AS $eachInvitationId) {
            delteObjectWithIdFromTable($eachInvitationId, "invitation");
        }
    }

    function saveTask($taskId, $name, $type, $unit) {
        $sql = "UPDATE task SET name = '$name', type = $type, unit = $unit WHERE id = $taskId";
        include_once("../database/databaseConnection.php");
        sendQuery($sql);
    }
?>