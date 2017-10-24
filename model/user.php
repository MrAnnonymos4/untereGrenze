<?php
    function checkUserMailAndPassword($anEmail, $aPassword) {
        include_once("../database/databaseConnection.php");
        $sql = "SELECT id FROM user WHERE email = '$anEmail' AND password = '$aPassword'";
        $connection = connectDb();
        $queryResult = $connection->query($sql);
        if ($queryResult->num_rows == 1) {
            while($row = $queryResult->fetch_assoc()) {
                $result = $row["id"];
            }
        } else {
            $result = -1;
        }
        return $result;
    }

    function nameOfUserWithId($userId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("name", $userId, "user");
    }
    function mailOfUserWithId($userId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("email", $userId, "user");
    }

    function allInvitationIdsForUserWithId($userId) {
        include_once("../database/databaseConnection.php");
        return getAllIdsOfTableWithCondition("invitation", "playerId = '$userId'");
    }

    function existInvitationForUserIdAndTaskId($userId, $taskId) {
        
        $theInvitationId = invitationForUserIdAndTaskId($userId, $taskId);
        return $theInvitationId != null;
    }

    function invitationForUserIdAndTaskId($userId, $taskId) {
        include_once("../database/databaseConnection.php");
        $invitations = getAllIdsOfTableWithCondition("invitation", "playerId = '$userId' AND taskId = '$taskId'");
        $invitationId = array_pop($invitations);
        return $invitationId;
    }

    function invitationVoteForUserIdAndTaskId($userId, $taskId) {
        include_once("invitation.php");
        $invitationId = invitationForUserIdAndTaskId($userId, $taskId);
        return voteForInvitationWithId($invitationId);
    }
?>