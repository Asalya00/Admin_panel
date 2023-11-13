<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p class="message-box">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Handle login form submission
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Perform database query to verify the login

                $conn = new mysqli('localhost', 'root', '', 'counsellingapp');
                if ($conn->connect_error) {
                    die('Connection Failed: ' . $conn->connect_error);
                }

                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['password'])) {
                        session_start();
                        $_SESSION['User_ID'] = $row['id'];
                        $_SESSION['User_Name'] = $row['firstname'];
                        $_SESSION['LoggedIn'] = true;
                        header('Location: profile.php');
                    } else {
                        echo "Your email or password is invalid";
                    }
                } else {
                    echo "Your email or password is invalid";
                }

                $conn->close();
            }
            ?>
        </p>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
</body>
</html>
