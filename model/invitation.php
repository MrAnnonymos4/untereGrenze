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

    //Sets the value of the invitation with the given id
    function setVoteForInvitationWithId($vote, $id) {
        include_once("../database/databaseConnection.php");
        $sql = "UPDATE invitation SET vote = $vote WHERE id = $id";
        sendQuery($sql);
    }
?>
