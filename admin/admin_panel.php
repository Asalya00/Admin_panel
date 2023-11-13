<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Database connection setup
$conn = new mysqli('localhost', 'root', '', 'counsellingapp');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Query to count registered doctors
$sqlDoctors = "SELECT COUNT(*) AS doctor_count FROM Doctors";
$resultDoctors = mysqli_query($conn, $sqlDoctors);

if (!$resultDoctors) {
    die('Query failed: ' . mysqli_error($conn));
}

$rowDoctors = mysqli_fetch_assoc($resultDoctors);
$doctorCount = $rowDoctors['doctor_count'];

// Query to count all registered users
$sqlUsers = "SELECT COUNT(*) AS user_count FROM users";
$resultUsers = mysqli_query($conn, $sqlUsers);

if (!$resultUsers) {
    die('Query failed: ' . mysqli_error($conn));
}

$rowUsers = mysqli_fetch_assoc($resultUsers);
$userCount = $rowUsers['user_count'];

// Query to count all appointments
$sqlAppointments = "SELECT COUNT(*) AS appointment_count FROM appointments";
$resultAppointments = mysqli_query($conn, $sqlAppointments);

if (!$resultAppointments) {
    die('Query failed: ' . mysqli_error($conn));
}

$rowAppointments = mysqli_fetch_assoc($resultAppointments);
$appointmentCount = $rowAppointments['appointment_count'];
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
        <p>Total Count of Registered Users: <?php echo $userCount; ?></p>
        <p>Total Count of Appointments: <?php echo $appointmentCount; ?></p>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</body>
</html>
