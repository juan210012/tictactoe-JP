<?php
  require("connect.php");
  session_start();
?>
<!DOCTYPE HTML>
<!--
Name: Juan Estupinan 
Student Number: 991593151
-->
<html lang="en">
  <head lang="en">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../CSS/TicTacToeA2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="utf-8">
  </head>
<!-- main content -->
  <body>
    <h1 class="title">Tic Tac Toe</h1>
    <?php
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        echo "<a class='logout' href='logout.php' title='Log Out'>Log Out</a>";
      } else {
        echo "<a class='logout' href='logout.php' title='Log In'>Log In</a> <a class='logout' href='../HTML/createAccount.html' title='Creat an Account'>Create an Account</a>";
      }
    ?>
    <p class="myName">A game experience by <span>Juan Estupinan</span></p><br>
    <!-- game board -->
    <div class="board">
    <?php
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $command = "SELECT `userName` FROM `userInfo` WHERE `userName`=?";
        $stmt = $dbConn->prepare($command);
        $execOk = $stmt->execute([$_SESSION["userName"]]);

        if($execOk) {
          echo "<h2>Welcome " . $stmt->fetchColumn() . "</h2><br>";
        }
      }
    ?>  
      <table class="board">
        <tr>
          <td class="cellPart" value="10"></td>
          <td class="cellPart" value="11"></td>
          <td class="cellPart" value="12"></td>
        </tr>
        <tr>
          <td class="cellPart" value="20"></td>
          <td class="cellPart" value="21"></td>
          <td class="cellPart" value="22"></td>
        </tr>
        <tr>
          <td class="cellPart" value="30"></td>
          <td class="cellPart" value="31"></td>
          <td class="cellPart" value="32"></td>
        </tr>
      </table>
      <div class="container2">
        <div class="item1">
          <h3>Select Player X or O</h3>
          <input type="radio" id="Xselect" name="playerSelect" value="X">
          <label for="Xselect">X</label>
          <input type="radio" id="Oselect" name="playerSelect" value="O">
          <label for="Oselect">O</label>
        </div>
        <div class="item2">
          <h3>Select Difficulty</h3>
          <input type="radio" id="easy" name="difficulty" value="easy">
          <label for="easy">Easy</label>
          <input type="radio" id="normal" name="difficulty" value="normal">
          <label for="normal">Normal</label>
          <input type="radio" id="hard" name="difficulty" value="hard">
          <label for="hard">Hard</label>
        </div>
        <div class="break"></div><br>
        <div class="item3"><button id="confirm">Confirm</button></div>
      </div>
      <!-- play information and controls -->
      <p>Player <span id="player"></span> Go!<br><br>
      <button id="reset">Reset Game</button>&nbsp;<button id="changeDiff">Change Player/Difficulty</button><br>
      </p>
    </div>
    <div class="container">
      <div class="leaderboard">
        <h2>Leader Boards</h2>
        <table>
          <tr>
            <th>Position</th>
            <th>Username</th>
            <th>Easy Wins</th>
            <th>Normal Wins</th>
            <th>Hard Wins</th>
            <th>Total Wins</th>
        </tr>
          <?php
            $command = "SELECT `userName`, `wins`, `nWins`, `aWins`, `totalWins` FROM `userInfo` ORDER BY `totalWins` DESC, `userName` ASC";
            $stmt = $dbConn->prepare($command);
            $execOk = $stmt->execute();

            if ($execOk) {
              $pos = 1;
              while($rows = $stmt->fetch()) {
                if ($pos < 11) {
                  echo "<tr>";
                  echo "<td>" . $pos . "</td>";
                  echo "<td>" . $rows["userName"] . "</td>";
                  echo "<td>" . $rows["wins"] . "</td>";
                  echo "<td>" . $rows["nWins"] . "</td>";
                  echo "<td>" . $rows["aWins"] . "</td>";
                  echo "<td>" . $rows["totalWins"] . "</td>";
                  echo "</tr>";
                }
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $rows["userName"] == $_SESSION["userName"]) {
                  $playerPos = $pos;
                }
                $pos++;
              }
            }
          ?>
        </table>
      </div>
      <div class="yourStats">
        <?php
          if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            $command = "SELECT `userName`, `wins`, `nWins`, `aWins`, `totalWins` FROM `userInfo` WHERE `userName`=?";
            $stmt = $dbConn->prepare($command);
            $execOk = $stmt->execute([$_SESSION["userName"]]);

            if($execOk) {
              while($rows = $stmt->fetch()) {
                echo "<h2>Your Stats</h2>";
                echo "<p> <b>#" . $playerPos . "</b> <span>" . $_SESSION["userName"] . "</span> &#8611; <b> Easy Wins:</b> " . $rows["wins"] . " <b>|| Normal Wins:</b> " . $rows["nWins"] . " <b>|| Hard Wins: </b>" . $rows["aWins"] . " <b>|| Total Wins:</b> " . $rows["totalWins"] . "</p>";
              }
            }
          } else {
            echo "<br><br><h2>If you sign up, you can track your wins and compete against others in the leaderboard!</h2>";
          }
        ?>
      </div>
      <!-- footer -->
      <div class="break"></div>
      <p class="copyright">© Juan Estupinan 2020. All Rights Reserved.</p>
    </div>
    <!-- hidden elements used for displaying results -->
    <div class="container2 message" name="message">
      <p>GAME OVER!</p>
        <h3 id="winner"></h3>
      <p>&mdash;click anywhere in the box to dismiss this message&mdash;</p>
    </div>
    <div id="overlay"></div>
    <script src="../JS/TicTacToeA2.js"></script>
  </body>
</html>