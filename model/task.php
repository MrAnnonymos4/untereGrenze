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

    function creatorNameOfTaskWithId($taskId) {
        require_once("user.php");
        include_once("../database/databaseConnection.php");
        $ownerId = getColumnOfRowWithIdInTable("creatorId", $taskId, "task");
        return nameOfUserWithId($ownerId);
    }

    function nameOfTaskWithId($taskId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("name",$taskId, "task");
    }
?>