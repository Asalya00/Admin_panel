<?php
session_start(); // Start the session

// Retrieve user ID from the query parameter
$userID = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientName = isset($_POST['patient_name']) ? $_POST['patient_name'] : "";
    $patientEmail = isset($_POST['patient_email']) ? $_POST['patient_email'] : "";
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_start_time'];
    $appointmentEndTime = $_POST['appointment_end_time'];
    $appointmentReason = $_POST['appointment_reason'];

    // Assuming 'doctor_id' is stored in a session variable
$doctorId = isset($_SESSION['doctor_id']) ? $_SESSION['doctor_id'] : 0;

// Insert booked appointment into the appointments table
$insertSql = "INSERT INTO appointments (patient_name, patient_email, appointment_date, appointment_start_time, appointment_end_time, appointment_reason, DoctorID)
              VALUES ('$patientName', '$patientEmail', '$appointmentDate', '$appointmentTime', '$appointmentEndTime', '$appointmentReason', '$doctorId')";
              
    // Check if the appointment slot is available
    $availabilitySql = "SELECT * FROM appointments WHERE user_id = '$userId' AND appointment_date = '$appointmentDate' AND ((appointment_start_time <= '$appointmentTime' AND appointment_end_time > '$appointmentTime') OR (appointment_start_time < '$appointmentEndTime' AND appointment_end_time >= '$appointmentEndTime'))";
    
    $availabilityResult = $conn->query($availabilitySql);
    
    if ($availabilityResult && $availabilityResult->num_rows > 0) {
        echo "This appointment slot is already booked. Please choose a different time.";
    } else {
        // Insert booked appointment into the appointments table
        $insertSql = "INSERT INTO appointments (patient_name, patient_email, appointment_date, appointment_start_time, appointment_end_time, appointment_reason, user_id)
                      VALUES ('$patientName', '$patientEmail', '$appointmentDate', '$appointmentTime', '$appointmentEndTime', '$appointmentReason', '$userId')";

        if ($conn->query($insertSql) === TRUE) {
            echo "Appointment booked successfully.";
        } else {
            echo "Error booking the appointment: " . $conn->error;
        }
    }
    header('Location: all.php');
    exit;
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="book.css">
</head>
<body>
    <h1>Book Appointment</h1>
    <form action="" method="post">
        <label for="patient_name">Patient Name:</label>
        <input type="text" id="patient_name" name="patient_name" required>
        <label for="patient_email">Patient Email:</label>
        <input type="email" id="patient_email" name="patient_email" required>
        <label for="appointment_date">Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" required>
        <label for="appointment_start_time">Start Time:</label>
        <input type="time" id="appointment_start_time" name="appointment_start_time" required>
        <label for="appointment_end_time">End Time:</label>
        <input type="time" id="appointment_end_time" name="appointment_end_time" required>
        <label for="appointment_reason">Reason for Appointment:</label>
        <textarea id="appointment_reason" name="appointment_reason" rows="4" required></textarea>
        <button type="submit">Book Appointment</button>
    </form>
</body>
</html>