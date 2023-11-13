<?php
session_start();

// Check if the admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin_panel.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Database connection parameters
    $servername = 'localhost';
    $username = 'root';
    $dbpassword = '';
    $dbName = 'counsellingapp';

    $conn = new mysqli($servername, $username, $dbpassword, $dbName);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepare and execute a query to retrieve admin credentials
    $stmt = $conn->prepare("SELECT `id`, `username`, `password` FROM `admins` WHERE `username` = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($adminId, $adminUsername, $adminHashedPassword);
        $stmt->fetch();
        // Verify the password
        if ($inputPassword == $adminHashedPassword) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $adminId; // You can store the admin ID in the session for future use if needed
            header('Location: admin_panel.php');
            exit();
        } else {
            $error_message = 'Invalid credentials. Please try again.';
        }
    } else {
        $error_message = 'Admin not found. Please try again.';
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_login.css">
</head>
<body>
    <div class="navbar">
        <a href="#">Home</a>
    
    <div class="form-container">
        <h1>Admin Login</h1>
        <?php
        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        }
        ?>
        <form method="post" action="admin_login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
