<?php
//Returns task status by name
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
 //Returns task creator ID   
    function creatorIdOfTaskWithId($taskId) {
        require_once("user.php");
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("creatorId", $taskId, "task");
    }
//Returns task creator name
    function creatorNameOfTaskWithId($taskId) {
        require_once("user.php");
        $ownerId = creatorIdOfTaskWithId($taskId);
        return nameOfUserWithId($ownerId);
    }
//Returns name of task
    function nameOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("name",$taskId, "task");
    }
//Returns task type by type ID
    function typeIdOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("type",$taskId, "task");
    }
//Returns task unit by unit ID
    function unitIdOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("unit",$taskId, "task");
    }
//Returns all invitations by ID for one task
    function allInvitationIdsForTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getAllIdsOfTableWithCondition("invitation", "taskId = '$taskId'");
    }



//Adds a task to a user
    function addTask($taskName, $userId) {
        include_once("../database/databaseConnection.php");
        $sql = "INSERT INTO task (name, creatorId) VALUES ('$taskName', $userId)";
        sendQuery($sql);
        return getHighstIdOfTable("task");
    }
//Deletes a task
    function deleteTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        delteObjectWithIdFromTable($taskId, "task");
        foreach (allInvitationIdsForTaskWithId($taskId) AS $eachInvitationId) {
            delteObjectWithIdFromTable($eachInvitationId, "invitation");
        }
    }
//Saves a task by writing into DB
    function saveTask($taskId, $name, $type, $unit) {
        $sql = "UPDATE task SET name = '$name', type = $type, unit = $unit WHERE id = $taskId";
        include_once("../database/databaseConnection.php");
        sendQuery($sql);
    }
?>
