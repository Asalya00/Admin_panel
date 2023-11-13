<?php
session_start();

if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] !== true) {
    header('Location: login.php');
    exit;
}

// Define variables with default values
$firstname = $lastname = $gender = $user_image = '';

// Handle profile edit form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle profile edit form submission
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
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
            // File uploaded successfully, now update the user's profile in the database
            $conn = new mysqli('localhost', 'root', '', 'counsellingapp');
            if ($conn->connect_error) {
                die('Connection Failed: ' . $conn->connect_error);
            }

            $id = $_SESSION['User_ID'];

            // Check if a new password is provided
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users
                        SET firstname='$firstname', lastname='$lastname', password='$hashed_password', gender='$gender', image='$targetFile'
                        WHERE id='$id'";
            } else {
                // If no new password is provided, update without changing the password
                $sql = "UPDATE users
                        SET firstname='$firstname', lastname='$lastname', gender='$gender', image='$targetFile'
                        WHERE id='$id'";
            }

            if ($conn->query($sql) === TRUE) {
                // Update successful
                header('Location: profile.php');
            } else {
                // Update failed
                echo "Error updating profile: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="editeprofile.css">
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>

        <form method="post" enctype="multipart/form-data">
    <label for="firstname">First Name:</label>
    <input type="text" name="firstname" id="firstname" required value="<?php echo $firstname; ?>">

    <label for="lastname">Last Name:</label>
    <input type="text" name="lastname" id="lastname" required value="<?php echo $lastname; ?>">

    <label for="password">New Password (leave blank to keep current password):</label>
    <input type="password" name="password" id="password">

    <!-- Add the confirmation password field -->
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password">

    <label for="gender">Gender:</label>
    <select name="gender" id="gender" required>
        <option value="male" <?php if ($gender === 'male') echo 'selected'; ?>>Male</option>
        <option value="female" <?php if ($gender === 'female') echo 'selected'; ?>>Female</option>
        <option value="other" <?php if ($gender === 'other') echo 'selected'; ?>>Other</option>
    </select>

    <label for="image">Profile Image (JPG, JPEG, PNG, GIF):</label>
    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png, .gif">

    <!-- Add a client-side image preview -->
    <img id="image-preview" src="<?php echo $user_image; ?>" alt="Profile Image" style="max-width: 200px; border-radius: 50%;">

    <input type="submit" value="Submit"> <!-- Submit button -->
    <a href="profile.php" class="profile-link">Go Back to Profile</a>

</form>

<script>
    // JavaScript for client-side image preview
    document.getElementById("image").addEventListener("change", function (e) {
        const preview = document.getElementById("image-preview");
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function () {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>
