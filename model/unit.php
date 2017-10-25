<?php
//Returns unitname
    function nameOfUnitWithId($unitId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("name", $unitId, "unit");
    }
?>
