<?php
//connect.php
try { 
        $dbConn = new  PDO("mysql:host=127.0.0.1;dbname=estupiju_tictactoe", "estupiju_guest", "phpGuest_2020"); 
    } catch (PDOException $e) { 
        echo "Connection error: " . $e->getMessage(); 
    }
?>