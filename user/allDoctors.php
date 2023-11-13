<?php 

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['LogedIn']) || $_SESSION['LogedIn'] !== TRUE) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>All User Profiles</title>
    <link rel="stylesheet" href="allDoctors.css">
</head>
<body>
    <header>
        <h1>All User Profiles</h1>
    </header>

    <div class="search-bar">
        <form action="" method="post">
            <input type="text" name="search" placeholder="Search Counselor Name">
            <button type="submit">Search</button>
            <a href="profile.php" class="profile-link">Go Back to Profile</a>
        </form>
    </div>

    <?php
   
    // Connect to the database (Replace these values with your actual database credentials)
    $conn = new mysqli('localhost','root','','counsellingapp');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Retrieve all user profiles from the database
    $sql = "SELECT * FROM doctors";
    
    // Check if the search form is submitted
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        // Modify the SQL query to include the search filter
        $sql .= " WHERE name LIKE '%$search%'";
    }
    
    $result = $conn->query($sql);

    // Check if there are any user profiles
    if ($result->num_rows > 0) {
        echo '<div class="profiles-container">';

        // Loop through each user Doctor and display their name and Doctor photo with a link to their Doctor
        while ($row = $result->fetch_assoc()) {
            echo '<div class="profile">';
            echo '<a href="ViewDoctorProfile.php?id=' . urlencode($row['id']) . '">'; // Updated link to Doctor.php
            echo '<img src="../Doctor/' . $row['profile_photo'] . '" alt="Profile Photo">';
            echo '<p>' . $row['name'] . '</p>';
            echo '</a>';
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo '<p>No user profiles found.</p>';
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
