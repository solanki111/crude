<?php
//DB details
$dbHost = 'localhost';
$dbUsername = 'crude';
$dbPassword = 'crude';
$dbName = 'crude';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
}