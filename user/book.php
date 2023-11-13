<?php
session_start(); // Start the session

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
    $appointmentStartTime = $_POST['appointment_start_time'];
    $appointmentEndTime = $_POST['appointment_end_time'];
    $appointmentReason = $_POST['appointment_reason'];

    // Assuming 'doctor_id' is stored in a session variable
    $doctorId = isset($_GET['doctor_id']) ? $_GET['doctor_id'] : 0;
    $userID = $_SESSION['UserID'];
        
    // Check if the appointment slot is available
    $availabilitySql = "SELECT * FROM appointments WHERE DoctorID = '$doctorId' AND appointment_date = '$appointmentDate' AND ((appointment_start_time <= 'appointmentStartTime' AND appointment_end_time > '$appointmentStartTime') OR (appointment_start_time < '$appointmentEndTime' AND appointment_end_time >= '$appointmentEndTime'))";
    
    $availabilityResult = $conn->query($availabilitySql);
    
    if ($availabilityResult && $availabilityResult->num_rows > 0) {
        echo "This appointment slot is already booked. Please choose a different time." . $conn->error . " <a href='book.php'>Go back to Book Appointment</a>";
    } else {
        // Insert booked appointment into the appointments table
        $insertSql = "INSERT INTO appointments (patient_name, patient_email, appointment_date, appointment_start_time, appointment_end_time, appointment_reason, PaitentID, DoctorID)
                      VALUES ('$patientName', '$patientEmail', '$appointmentDate', '$appointmentStartTime', '$appointmentEndTime', '$appointmentReason', '$userID', '$doctorId')";

if ($conn->query($insertSql) === TRUE) {
    // If the appointment is booked successfully, display a button to go to profile.php
    echo "Appointment booked successfully. <a href='Viewprofile.php'>Go back to Profile</a>";
} else {
    // If there is an error, display a button to go back to book.php
    echo "Error booking the appointment: " . $conn->error . " <a href='book.php'>Go back to Book Appointment</a>";
}
    }
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
    <button onclick=History. back()>Go back to Profile</button>
</body>
</html>