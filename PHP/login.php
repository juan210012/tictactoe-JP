<?php
    require("connect.php");

    $userName = $_POST["userName"];
    $password = $_POST["password"];

    $command = "SELECT `hash` FROM `userInfo` WHERE `userName`=?";
    $stmt = $dbConn->prepare($command);
    $execOk = $stmt->execute([$username]);

    $hash = $stmt->fetch();

    if (password_verify($password, $hash)) {
        header("Location: https://estupiju.dev.fast.sheridanc.on.ca/tictactoe/");
        die();
    } else {
        header("Location: https://estupiju.dev.fast.sheridanc.on.ca/tictactoe/");
        die();
    }
?>