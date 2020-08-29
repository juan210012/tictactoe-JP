<?php
    require("connect.php");
    $userName = $_POST["userName"];
    $password = $_POST["password"];
    $taken = 0;

    $command = "SELECT `userName` FROM `userInfo`";
    $stmt = $dbConn->prepare($command);
    $execOk = $stmt->execute();

    while($users = $stmt->fetch()) {
        if ($users["userName"]==$userName) {
            $taken++;
            header("location: ../HTML/accountFail.html");
            exit();
            break;
        }
    }
    if ($taken == 0) {
        $command = "INSERT INTO `userInfo` (`id`, `userName`, `hash`, `wins`, `nWins`, `aWins`) VALUES (NULL, ?, ?, 0, 0, 0)";
        $stmt = $dbConn->prepare($command);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $execOk = $stmt->execute([$userName, $hash]);
        header("location: ../HTML/accountRegistered.html");
    }
?>