<?php
require_once 'DBconfig.php';
require_once 'DB.php';
session_start(); // Start the session
// require_once '../main.js';

// Example of using the DatabaseConnection class
$database = new DB();
$SubDB = new SubDB();
$conn = $database->getConnection();

// Perform your database operations using $conn

// close the connection
// $database->closeConnection();

?>