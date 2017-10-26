<?php
    require_once("../model/task.php");
    $taskId = $_GET["taskId"];
    closeTaskWithId($taskId);
    echo "Task closed";
?>