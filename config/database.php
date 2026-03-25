<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "czmpc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection at the Database failed". $conn->connect_error);
} else {
    echo "Connected Successfully to the MySQL Database!";
}

?>