<?php
session_start();

if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] !== true) {
    header('Location: login.php');
    exit;
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "counsellingapp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from the database based on the user's ID stored in the session
$user_id = $_SESSION['User_ID'];

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $gender = $row['gender'];
    $user_image = $row['image']; // Assuming the column name is 'image' in your database
} else {

}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['User_Name']; ?></h1>
        <div class="profile-info">
            <img src="<?php echo $user_image; ?>" alt="Profile Image">
            <p><strong>First Name:</strong> <?php echo $firstname; ?></p>
            <p><strong>Last Name:</strong> <?php echo $lastname; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Gender:</strong> <?php echo $gender; ?></p>
        </div>
        <div class="profile-actions">
    <a href="editeprofile.php">Edit Profile</a>
    <a href="deleteprofile.php">Delete Profile</a>
    <a href="logout.php">Logout</a>
    <a href="allDoctors.php">Choose Doctor</a>
</div>
    </div>
</body>
</html>

