<?php
    require_once("../model/invitation.php");
    $taskId = $_GET["taskId"];
    $playerId = $_GET["userId"];
    createInvitation($taskId, $playerId);
?>