<?php
    session_start();
    require("../connect.php");
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $command = "UPDATE `userInfo` SET `wins`=`wins` + 1, `totalWins`=`totalWins` + 1 WHERE `userName`=?";
        $stmt = $dbConn->prepare($command);
        $execOk = $stmt->execute([$_SESSION["userName"]]);
    }
?>