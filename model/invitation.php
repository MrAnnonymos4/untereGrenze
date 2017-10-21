<?php
    function taskIdOfInivitationWithId($id) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("taskId", $id, "invitation");
    }

    function taskNameOfInivitationWithId($id) {
        include_once("../database/databaseConnection.php");
        $theTaskId = taskIdOfInivitationWithId($id);
        return getColumnOfRowWithIdInTable("name", $theTaskId, "task");
    }

    function creatorNameOfInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        include_once("task.php");
        $theTaskId = taskIdOfInivitationWithId($id);
        return creatorNameOfTaskWithId($theTaskId);
    }

    function statusNameForInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        $theStatusArray = array(
            0 => "eingeladen",
            1 => "angenommen",
            2 => "abgelehnt",
        );
        return $theStatusArray[statusNumberForInvitationWithId($id)];
    }

    function statusNumberForInvitationWithId($id) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("status", $id, "invitation");
    }
?>