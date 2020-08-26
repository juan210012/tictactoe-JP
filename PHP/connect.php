<?php
//connect.php
try { 
    $dbConn = new  PDO("mysql:host=localhost:3306;dbname=estupiju_tictactoe", "estupiju_guest", "phpGuest_2020"); 
    } catch (PDOException $e) { 
        echo "Connection error: " . $e->getMessage(); 
    }
?>