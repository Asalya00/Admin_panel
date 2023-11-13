<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <h1>Registration</h1>
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle registration form submission
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    // Image handling
    $targetDir = "uploads/"; // Define the directory where the images will be stored
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
    } elseif ($_FILES["image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
    } elseif (
        $imageFileType != "jpg" && $imageFileType != "jpeg"
        && $imageFileType != "png" && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    } else {
        // If all checks pass, move the file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now insert the user into the database
            $conn = new mysqli('localhost', 'root', '', 'counsellingapp');
            if ($conn->connect_error) {
                die('Connection Failed: ' . $conn->connect_error);
            }

            // Check if the email already exists
            $sql = "SELECT id FROM users WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "A user with the given email already exists";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (firstname, lastname, email, password, gender, image)
                        VALUES ('$firstname', '$lastname', '$email', '$hashed_password', '$gender', '$targetFile')";

if ($conn->query($sql) === TRUE) {
    echo "Registration Complete. You can login using your email and password.";
    
    // Redirect to the login page after registration is complete
    header("Location: login.php");
    exit(); // Ensure that the script terminates to perform the redirection
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

            }

            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

        <form method="post" enctype="multipart/form-data">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" required>
            
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" id="lastname" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            
            <label for="image">Profile Image (JPG, JPEG, PNG, GIF):</label>
            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png, .gif" required>
            
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login Up</a></p>
        </form>
    </div>
</body>
</html>
