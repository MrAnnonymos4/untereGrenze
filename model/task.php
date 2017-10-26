<?php

    //Returns textual description for taskID
    function statusNameForTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        
        $theStatusArray = array(
            0 => "offen",
            1 => "geschlossen"
        );
        $theStatusNumber = getColumnOfRowWithIdInTable("status", $taskId, "task");
        return $theStatusArray[$theStatusNumber];
    }

    //Returns creatorID for taskID  
    function creatorIdOfTaskWithId($taskId) {
        require_once("user.php");
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("creatorId", $taskId, "task");
    }
    
    //Returns creatorname for taskID
    function creatorNameOfTaskWithId($taskId) {
        require_once("user.php");
        $ownerId = creatorIdOfTaskWithId($taskId);
        return nameOfUserWithId($ownerId);
    }
    
    //Returns taskname for taskID
    function nameOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("name",$taskId, "task");
    }

    //Returns task typeID for taskID
    function typeIdOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("type",$taskId, "task");
    }
    
    //Returns task unitID for taskID
    function unitIdOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("unit",$taskId, "task");
    }
    
    //Returns all linked invitationIDs for taskID
    function allInvitationIdsForTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getAllIdsOfTableWithCondition("invitation", "taskId = '$taskId'");
    }

    function closeTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        $sql = "UPDATE task SET status = 1 WHERE id = $taskId";
        echo "$sql";
        sendQuery($sql);
    }


    //Adds a task created by the given userId
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
