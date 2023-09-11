<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location:admin_login.php');
    exit();
}

// Database connection setup
$conn = new mysqli('localhost', 'root', '', 'counsellingapp'); // Adjust the credentials as needed
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Query to count registered doctors
$sql = "SELECT COUNT(*) AS doctor_count FROM users";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$doctorCount = $row['doctor_count'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="admin_panel.css">
    <title>Admin Panel</title>
</head>
<body>
    
    <div class="container">
        <h1>Admin Panel</h1>
        <p>Total Count of Registered Doctors: <?php echo $doctorCount; ?></p>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</body>
</html>
