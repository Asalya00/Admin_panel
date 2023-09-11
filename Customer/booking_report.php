<?php
// Start the session
session_start();

// Retrieve booking information from the database
$conn = new mysqli('localhost', 'root', '', 'counsellingapp');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

$doctorId = isset($_SESSION['doctor_id']) ? $_SESSION['doctor_id'] : 0;

$sql = "SELECT * FROM appointments WHERE doctor_id = '$doctorId'"; // Modify this query based on your database schema
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error executing the query: ' . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Report</title>
    <link rel="stylesheet" href="report.css">
</head>
<body>
    <h1>Booking Report</h1>
    <table>
        <tr>
            <th>Patient Name</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['patient_name'] . "</td>";
            echo "<td>" . $row['appointment_date'] . "</td>";
            echo "<td>" . $row['appointment_start_time'] . " - " . $row['appointment_end_time'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

