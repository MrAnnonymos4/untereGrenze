<?php
    function nameOfTaskTypeWithId($typeId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("name", $typeId, "taskType");
    }
?>