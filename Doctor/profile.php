<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['LogedIn']) || $_SESSION['LogedIn'] !== TRUE) {
    header('Location: login.php');
    exit;
}

// Retrieve user Doctor information from the database based on the UserID in the session
$conn = new mysqli('localhost', 'root', '', 'counsellingapp');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $userID = $_SESSION['UserID'];
    $sql = "SELECT * FROM users WHERE id = '$userID'";
    $result = mysqli_query($conn, $sql);
    
    if ($result === FALSE || mysqli_num_rows($result) == 0) {
        echo "Error fetching user Doctor";
        exit;
    }

    $row = mysqli_fetch_array($result);
    $name = $row['name'];
    $email = $row['email'];
    $age = $row['age'];
    $gender = $row['gender'];
    $therapyType = $row['therapy_type'];
    $whatsapp = $row['whatsapp'];
    $facebook = $row['facebook'];
    $experience = $row['experience'];
    $quote = $row['quote'];
    $password = $row['password'];
    $confirm_password = $row['confirm_password'];
    $profilePhoto = $row['profile_photo'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
        </div>
        <h1 id="title">Welcome <?php echo $name; ?>!</h1>
        <!-- Display the user Doctor information -->
        <div class="profile-section">
            <h2>Profile Information</h2>
            <p>Name: <?php echo $name; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Age: <?php echo $age; ?></p>
            <p>Gender: <?php echo $gender; ?></p>
            <p>Therapy Type: <?php echo $therapyType; ?></p>
            <p>WhatsApp: <?php echo $whatsapp; ?></p>
            <p>Facebook: <?php echo $facebook; ?></p>
            <p>Experience: <?php echo $experience; ?></p>
            <!-- Display the Doctor photo -->
            <img src="<?php echo $profilePhoto; ?>" alt="Profile Photo" width="150" height="150">
            <p>Quote: <?php echo $quote; ?></p>
        </div>

        <div class="profile-actions">
            <!-- Add Edit Profile,callender and Delete Profile buttons -->
            <a href="edit.php">Edit Profile</a>
            <a href="availableTimes.php">Edit Time Slots</a>
            <form action="delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete your Doctor? This action cannot be undone.');">
                <button type="submit" name="deleteProfile" class="delete-button">Delete Profile</button>
            </form>
            <!-- Logout Button -->
            <a href="logout.php">Logout</a>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script>
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('confirm_password');
        const signUpButton = document.querySelector('.form-container.sign-up-container button');

        function validatePassword() {
            const password = passwordField.value;
            const confirmPassword = confirmPasswordField.value;

            if (password !== confirmPassword) {
                signUpButton.disabled = true;
                confirmPasswordField.setCustomValidity("Passwords do not match");
            } else {
                signUpButton.disabled = false;
                confirmPasswordField.setCustomValidity("");
            }
        }

        passwordField.addEventListener('input', validatePassword);
        confirmPasswordField.addEventListener('input', validatePassword);
    </script>
      <div class="container" id="time-container">
        <!-- Display the doctor's available time slots -->
        <h2>Available Time Slots</h2>
        <?php
        // Fetch doctor's available time slots from the database
        $sql = "SELECT * FROM time WHERE doctor_id = '$userID'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>Date: " . $row['appointment_date'] . " | Time: " . $row['appointment_start_time'] ." - ".$row['appointment_end_time'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No available time slots added by the doctor.</p>";
        }
        ?>
         <!-- Link to the Booking Report page -->
    <div class="booking-report-link">
        <a href="../Customer/booking_report.php">View Booking Report</a>
    </div>
    </div>
</div>
</body>
</html>
