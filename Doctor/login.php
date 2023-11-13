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
        <?php
        // Start the session
        session_start();

        $email = $_POST['email'];
        $password = $_POST['password'];

        // LOGIN
        $conn = new mysqli('localhost', 'root', '', 'counsellingapp');
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        } else {
            $sql = "SELECT * FROM doctors WHERE Email = '$email' AND Password = '" . md5($password) . "'";

            $result = mysqli_query($conn, $sql);
            if ($result == False) {
                echo "Error";
            } else {
                $row = mysqli_fetch_array($result);
                $count = mysqli_num_rows($result);
            }

            if ($count == 1) {
                $_SESSION['User_Name'] = $row['name'];
                $_SESSION['UserID'] = $row['id'];
                $_SESSION['LogedIn'] = TRUE;
                header('Location: Profile.php');
            } else {
                echo '<p class="message-box">Your Login Name or Password is invalid</p>';
                echo '<a href="index.php" class="redirect-button">Go Back</a>';
            }
        }
        ?>
    </div>
</body>
</html>
