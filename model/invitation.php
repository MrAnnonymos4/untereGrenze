<?php
//Returns invitation taskID
    function taskIdOfInivitationWithId($id) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("taskId", $id, "invitation");
    }
//Returns invitation name
    function taskNameOfInivitationWithId($id) {
        include_once("../database/databaseConnection.php");
        $theTaskId = taskIdOfInivitationWithId($id);
        return getColumnOfRowWithIdInTable("name", $theTaskId, "task");
    }
//Returns invitation creator name
    function creatorNameOfInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        include_once("task.php");
        $theTaskId = taskIdOfInivitationWithId($id);
        return creatorNameOfTaskWithId($theTaskId);
    }
//Returns invitation status by description
    function statusNameForInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        $theStatusArray = array(
            0 => "eingeladen",
            1 => "angenommen",
            2 => "abgelehnt",
        );
        return $theStatusArray[statusNumberForInvitationWithId($id)];
    }
//Returns invitation status by number
    function statusNumberForInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("status", $id, "invitation");
    }
//Returns vote for invitation
    function voteForInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("vote", $id, "invitation");
    }
//Create new Invitation
    function createInvitation($taskId, $userId) {
        include_once("../database/databaseConnection.php");
        $sql = "INSERT INTO invitation (taskId, playerId) VALUES ($taskId, $userId)";
        sendQuery($sql);
    }
?>
