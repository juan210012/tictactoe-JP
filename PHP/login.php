<?php
    session_start();
    require("connect.php");
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: welcome.php");
        exit;
    }

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
        header("Location: https://estupiju.dev.fast.sheridanc.on.ca/tictactoe/");
        exit();
    } else {
        header("Location: https://estupiju.dev.fast.sheridanc.on.ca/tictactoe/");
        exit();
    }
?>