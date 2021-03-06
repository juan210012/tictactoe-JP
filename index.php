<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: PHP/TicTacToeA2.php");
    exit;
}
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
        <h1 class="title">Tic Tac Toe</h1>
        <p class="myName">A game experience by <span>Juan Estupinan</span></p>
        <div class="mainPart">
            <h1 class="header">Welcome</h1>
            <form method="post" action="PHP/login.php">
                <label for="userName">User Name</label><br>
                <input type="text" id="userName" name="userName" maxlength="15" required><br>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" maxlength="60" required><br><br>
                <input class="submitButton" type="submit" value="Log In"><br><br>
            </form>
            <a href="HTML/createAccount.html" title="Create New Account">Create New Account</a> <b>||</b>
            <a href="PHP/TicTacToeA2.php" title="Play as Guest">Play as Guest</a>
        </div>
        <p class="copyright">© Juan Estupinan 2020. All Rights Reserved.</p>
    </body>
</html>