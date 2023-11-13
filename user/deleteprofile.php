<?php
session_start();

if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] !== true) {
    header('Location: login.php');
    exit;
}

// Handle profile deletion here
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Delete Profile</title>
</head>
<body>
    <div class="container">
        <h1>Delete Profile</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle profile deletion
            $id = $_SESSION['User_ID'];

            // Perform deletion in the database
            $conn = new mysqli('localhost', 'root', '', 'counsellingapp');
            if ($conn->connect_error) {
                die('Connection Failed: ' . $conn->connect_error);
            }

            $sql = "DELETE FROM users WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                // Deletion successful, log the user out
                session_unset();
                session_destroy();
                header('Location: login.php');
            } else {
                // Deletion failed
                echo "Error deleting profile: " . $conn->error;
            }

            $conn->close();
        }
        ?>
        <p>Are you sure you want to delete your profile?</p>
        <form method="post">
            <input type="submit" value="Yes, Delete My Profile">
        </form>
    </div>
</body>
</html>
