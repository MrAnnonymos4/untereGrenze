<?php
//Returns taskID for invitation ID
    function taskIdOfInivitationWithId($id) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("taskId", $id, "invitation");
    }
//Returns taskname for invitation ID
    function taskNameOfInivitationWithId($id) {
        include_once("../database/databaseConnection.php");
        $theTaskId = taskIdOfInivitationWithId($id);
        return getColumnOfRowWithIdInTable("name", $theTaskId, "task");
    }
//Returns creatorname for invitation ID
    function creatorNameOfInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        include_once("task.php");
        $theTaskId = taskIdOfInivitationWithId($id);
        return creatorNameOfTaskWithId($theTaskId);
    }
//Returns textual status description for invitation ID
    function statusNameForInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        $theStatusArray = array(
            0 => "eingeladen",
            1 => "angenommen",
            2 => "abgelehnt",
        );
        return $theStatusArray[statusNumberForInvitationWithId($id)];
    }
//Returns numerical status description for invitation ID
    function statusNumberForInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("status", $id, "invitation");
    }
//Returns vote for invitation ID
    function voteForInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("vote", $id, "invitation");
    }
//Creates a new Invitation
    function createInvitation($taskId, $userId) {
        include_once("../database/databaseConnection.php");
        $sql = "INSERT INTO invitation (taskId, playerId) VALUES ($taskId, $userId)";
        sendQuery($sql);
    }
?>
