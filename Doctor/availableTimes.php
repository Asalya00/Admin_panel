<?php
session_start();
$userID = $_SESSION['UserID'];; // Replace with the actual user ID

// Database connection parameters
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'counsellingapp';

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the form is submitted for adding available time slots
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointmentDate = $_POST['appointment_date'];
    $appointmentStartTime = $_POST['appointment_start_time'];
    $appointmentEndTime = $_POST['appointment_end_time'];
    $appointmentDay = date('l', strtotime($appointmentDate));

    // Insert available time slot into the time table
    $insertSql = "INSERT INTO time (user_id, appointment_date, appointment_start_time, appointment_end_time, appointment_day)
                  VALUES ('$userID', '$appointmentDate', '$appointmentStartTime', '$appointmentEndTime', '$appointmentDay')";

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Available Time Slots</title>
    <link rel="stylesheet" href="availableTimes.css">
</head>
<body>
    <h1>Available Time Slots</h1>
    <form action="" method="post">
        <label for="appointment_date">Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" required>
        <label for="appointment_start_time">Start Time:</label>
        <input type="time" id="appointment_start_time" name="appointment_start_time" required>
        <label for="appointment_end_time">End Time:</label>
        <input type="time" id="appointment_end_time" name="appointment_end_time" required>
        <button type="submit">Add Time Slot</button>
    </form>
    <button onclick="location.href='Profile.php'">Go back to Profile</button>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($conn->query($insertSql) === TRUE) {
            // If the time slot is added successfully, display a success message as a button
            echo '<button onclick="location.href=\'profile.php\'">Available time slot added successfully</button>';
        } else {
            // If there is an error, display an error message as a button
            echo '<button onclick="location.href=\'availableTimes.php\'">Error adding the available time slot: ' . $conn->error . '</button>';
        }
    }
    ?>
</body>
</html>
