<?php
    require_once("../model/invitation.php");
    $id = $_GET["invitationId"];
    $vote = $_GET["value"];
    setVoteForInvitationWithId($vote, $id);
    echo "Sucessful set";
?>