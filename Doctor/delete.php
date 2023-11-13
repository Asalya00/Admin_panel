<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['LogedIn']) || $_SESSION['LogedIn'] !== TRUE) {
    header('Location: login.php');
    exit;
}

// Database connection parameters
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'counsellingapp';

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Retrieve the UserID from the session
$userID = $_SESSION['UserID'];

// Delete the user's Doctor
$deleteSql = "DELETE FROM doctors WHERE id = '$userID'";
if ($conn->query($deleteSql) === TRUE) {
    // Unset all of the session variables and destroy the session
    session_unset();
    session_destroy();
    
    // Redirect to index.php
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting Doctor: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
