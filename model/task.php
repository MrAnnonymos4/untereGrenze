<?php

    //Returns textual description for taskID
    function statusNameForTaskWithId($taskId) {
        $theStatusArray = array(
            0 => "offen",
            1 => "geschlossen"
        );
        $theStatusNumber = getStatusNumberOfTaskWithId($taskId);
        return $theStatusArray[$theStatusNumber];
    }

    function getStatusNumberOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("status", $taskId, "task");
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

    function resultOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("result",$taskId, "task");
    }

    //Closes the task with the given id
    function closeTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        $taskType = typeIdOfTaskWithId($taskId);
        $invitationIds = allInvitationIdsForTaskWithId($taskId);
        $votes = array();
        include_once("invitation.php");
        foreach ($invitationIds AS $eachVoteId) {
            $vote = voteForInvitationWithId($eachVoteId);
            if ($vote >= 0) {
                array_push($votes, $vote);
            }
        }
        //Median
        if ($taskType == 0) {
            $max = max($votes);
            $min = min($votes);
            $result = ($max + $min) / 2;
        } else {
            $sum = 0;
            foreach ($votes AS $eachVote) {
                $sum += $eachVote;
            }
            $result = $sum / count($votes);
        }
        $sql = "UPDATE task SET status = 1, result = $result WHERE id = $taskId";
        sendQuery($sql);
        echo $result;
    }

    //Answers whether the task with the given id is open or not
    function isOpen($taskId) {
        return getStatusNumberOfTaskWithId($taskId) == 0;
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
        deleteObjectWithIdFromTable($taskId, "task");
        foreach (allInvitationIdsForTaskWithId($taskId) AS $eachInvitationId) {
            deleteObjectWithIdFromTable($eachInvitationId, "invitation");
        }
    }

    //Saves a task by writing into DB
    function saveTask($taskId, $name, $type, $unit) {
        $sql = "UPDATE task SET name = '$name', type = $type, unit = $unit WHERE id = $taskId";
        include_once("../database/databaseConnection.php");
        sendQuery($sql);
    }
?>
