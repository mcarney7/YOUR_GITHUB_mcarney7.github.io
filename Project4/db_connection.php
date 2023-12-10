<?php
session_start();
function openDatabaseConnection() {
    $host = "localhost";
    $user = "kanam1";
    $pass = "kanam1";
    $dbname = "kanam1";

    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function closeDatabaseConnection($conn) {
    $conn->close();
}
?>
