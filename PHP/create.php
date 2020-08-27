<?php

    $userName = $_POST["userName"];
    $password = $_POST["password"];
    $taken = 0;

    $command = "SELECT `userName` FROM `userInfo`";
    $stmt = $dbConn->prepare($command);
    $execOk = $stmt->execute();

    while($users = $stmt->fetch()) {
        if ($users["userName"]==$userName) {
            ?>
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <title>Tic Tac Toe!</title>
                        <meta charset="utf-8">
                        <link rel="stylesheet" href="../CSS/formatting.css" type="text/css">
                        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
                        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
                    </head>
                    <body>
                        <h1 class="title">Tic Tac Toe</h1>
                        <p  class="myName">A game experience by <span>Juan Estupinan</span></p>
                        <div class="mainPart2">
                            <h1 class="header">Username is already taken!</h1>
                            <a href="../HTML/createAccount.html" title="Go Back">Go Back</a>
                        </div>
                        <p class="copyright">© Juan Estupinan 2020. All Rights Reserved.</p>
                    </body>
                </html>
            <?php
            $taken++;
            break;
        }
    }
    if ($taken == 0) {
        $command = "INSERT INTO `userInfo` (`id`, `userName`, `hash`, `wins`) VALUES (NULL, ?, ?, 0)";
        $stmt = $dbConn->prepare($command);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $execOk = $stmt->execute([$userName, $hash]);
        ?>
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <title>Tic Tac Toe!</title>
                        <meta charset="utf-8">
                        <link rel="stylesheet" href="../CSS/formatting.css" type="text/css">
                        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
                        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
                    </head>
                    <body>
                        <h1 class="title">Tic Tac Toe</h1>
                        <p  class="myName">A game experience by <span>Juan Estupinan</span></p>
                        <div class="mainPart2">
                            <h1 class="header">Account Creation Successful!</h1>
                            <a href="..index.html" title="Login">Login</a>
                        </div>
                        <p class="copyright">© Juan Estupinan 2020. All Rights Reserved.</p>
                    </body>
                </html>
            <?php
    }
?>