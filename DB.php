<?php
//Database Details
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jchanreborn';
//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    echo 'Error: Cannot connect to Database';
}
?>