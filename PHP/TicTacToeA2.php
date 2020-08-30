<?php
  require("connect.php");
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
    <p class="myName">A game experience by <span>Juan Estupinan</span></p>
    <!-- game board -->
    <div class="board">
    <?php
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $command = "SELECT `userName` FROM `userInfo` WHERE `userName`=?";
        $stmt = $dbConn->prepare($command);
        $execOk = $stmt->execute([$_SESSION["userName"]]);

        if($execOk) {
          echo "<h2>Welcome " . $stmt->fetchColumn() . "</h2>";
        }
      }
    ?>  
      <table>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
      <!--
        TODO: ADD A DIFFICULTY AND X OR O SELECTION SYSTEM
      -->
      <!-- play information and controls -->
      <p>Player <span id="player"></span> Go!<br>
      <button id="reset">Reset Game</button>
      </p>
    </div>
    <div>
      <h3>Leader Boards</h3>
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
          <h3>Your Stats</h3>
    <?php
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $command = "SELECT `userName`, `wins`, `nWins`, `aWins`, `totalWins` FROM `userInfo` WHERE `userName`=?";
        $stmt = $dbConn->prepare($command);
        $execOk = $stmt->execute([$_SESSION["userName"]]);

        if($execOk) {
          while($rows = $stmt->fetch()) {
            echo "<p> " . $playerPos . " " . $_SESSION["userName"] . " Easy Wins: " . $rows["wins"] . " Normal Wins: " . $rows["nWins"] . " Hard Wins: " . $rows["aWins"] . " Total Wins: " . $rows["totalWins"] . "</p>";
          }
        }
      }
    ?>
    <!-- footer -->
    <p class="copyright">© Juan Estupinan 2020. All Rights Reserved.</p>

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