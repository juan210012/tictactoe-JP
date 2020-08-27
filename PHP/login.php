<?php
    session_start();
    require("connect.php");

    $userName = $_POST["userName"];
    $password = $_POST["password"];

    $command = "SELECT `hash` FROM `userInfo` WHERE `userName`=?";
    $stmt = $dbConn->prepare($command);
    $execOk = $stmt->execute([$username]);

    $hash = $stmt->fetch();

    if (password_verify($password, $hash)) {
        session_start();
                            
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["userName"] = $userName;
        header("location: ../HTML/TicTacToeA2.html");
        exit();
    } else {
        header("location: ../HTML/errorPage.html");
        exit();
    }
?>