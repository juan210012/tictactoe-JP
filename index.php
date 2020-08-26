<?php
    require("PHP/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tic Tac Toe!</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/formatting.css" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="mainPart">
            <h1 class="header">Welcome</h1>
            <form method="post" action="login.php">
                <label for="userName">User Name</label><br>
                <input type="text" id="userName" name="userName"><br>
                <label for="password">Password</label><br>
                <input type="text" id="password" name="password"><br><br>
                <input type="submit" value="Log In"><br>
            </form>
            <a href="PHP/createAccount.php" title="Create New Account">Create New Account</a>
            <a href="PHP/guest.php" title="Play as Guest">Play as Guest</a>
        </div>
        <script src="JS/scriptIndex.js"></script>
    </body>
</html>