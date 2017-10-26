<?php
    //Checks usermail and password. Returns negative result as "-1"
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
    //Returns username for userID
    function nameOfUserWithId($userId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("name", $userId, "user");
    }
    //Returns usermail for userID
    function mailOfUserWithId($userId) {
        include_once("../database/databaseConnection.php");
        return getColumnOfRowWithIdInTable("email", $userId, "user");
    }
    //Returns all invitations for userID
    function allInvitationIdsForUserWithId($userId) {
        include_once("../database/databaseConnection.php");
        return getAllIdsOfTableWithCondition("invitation", "playerId = '$userId'");
    }
    //Checks for linked task for userID. Returns result by boolean
    function existInvitationForUserIdAndTaskId($userId, $taskId) {
        $theInvitationId = invitationForUserIdAndTaskId($userId, $taskId);
        return $theInvitationId != null;
    }

    //Returns invitationID for userID and taskID
    function invitationForUserIdAndTaskId($userId, $taskId) {
        include_once("../database/databaseConnection.php");
        $invitations = getAllIdsOfTableWithCondition("invitation", "playerId = '$userId' AND taskId = '$taskId'");
        $invitationId = array_pop($invitations);
        return $invitationId;
    }
    //Returns invitationvote for userID and taskID
    function invitationVoteForUserIdAndTaskId($userId, $taskId) {
        include_once("invitation.php");
        $invitationId = invitationForUserIdAndTaskId($userId, $taskId);
        return voteForInvitationWithId($invitationId);
    }
?>
