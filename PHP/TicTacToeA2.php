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
          <td class="cellPart"></td>
          <td class="cellPart"></td>
          <td class="cellPart"></td>
        </tr>
        <tr>
          <td class="cellPart"></td>
          <td class="cellPart"></td>
          <td class="cellPart"></td>
        </tr>
        <tr>
          <td class="cellPart"></td>
          <td class="cellPart"></td>
          <td class="cellPart"></td>
        </tr>
      </table>
      <!--
        TODO: ADD A DIFFICULTY AND X OR O SELECTION SYSTEM
      -->
      <!-- play information and controls -->
      <p>Player <span id="player"></span> Go!<br><br>
      <button id="reset">Reset Game</button><br>
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
    <div id="message">
      <p>GAME OVER!</p>
        <h3 id="winner"></h3>
      <p>&mdash;click anywhere in the box to dismiss this message&mdash;</p>
    </div>
    <div id="overlay"></div>
    <script src="../JS/TicTacToeA2.js"></script>
  </body>
</html>