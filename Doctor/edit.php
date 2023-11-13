<?php
session_start();

if (!isset($_SESSION['LogedIn']) || $_SESSION['LogedIn'] !== TRUE) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'counsellingapp');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $userID = $_SESSION['UserID'];
    $sql = "SELECT * FROM doctors WHERE id = '$userID'";
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

    $updateSql = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updatedName = $_POST['name'];
        $updatedEmail = $_POST['email'];
        $updatedAge = $_POST['age'];
        $updatedGender = $_POST['gender'];
        $updatedTherapyType = $_POST['therapy_type'];
        $updatedWhatsapp = $_POST['whatsapp'];
        $updatedFacebook = $_POST['facebook'];
        $updatedExperience = $_POST['experience'];
        $updatedQuote = $_POST['quote'];

        if (isset($_POST['password']) && isset($_POST['confirm_password']) && $_POST['password'] == $_POST['confirm_password']) {
            $updatedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }

        if (!empty($_FILES['profile_photo']['name'])) {
            $targetDir = "profile_photos/";
            $targetFile = $targetDir . basename($_FILES["profile_photo"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFile)) {
                    $profilePhoto = $targetFile;
                } else {
                    echo "Error uploading the Doctor photo.";
                }
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        }

        $updateSql = "UPDATE doctors SET name=?, email=?, age=?, gender=?, therapy_type=?, whatsapp=?, facebook=?, experience=?, quote=?";
        $params = array($updatedName, $updatedEmail, $updatedAge, $updatedGender, $updatedTherapyType, $updatedWhatsapp, $updatedFacebook, $updatedExperience, $updatedQuote);

        if (isset($updatedPassword)) {
            $updateSql .= ", password=?";
            $params[] = $updatedPassword;
        }

        $updateSql .= ", profile_photo=?";
        $params[] = $profilePhoto;

        $updateSql .= " WHERE id=?";
        $params[] = $userID;

        $stmt = $conn->prepare($updateSql);
        if ($stmt) {
            $types = str_repeat("s", count($params));
            $stmt->bind_param($types, ...$params);
            if ($stmt->execute()) {
                echo "Profile updated successfully.";
                header('Location: Doctor.php');
                exit;
            } else {
                echo "Error updating the Doctor: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing update statement: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="edit.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <form id="profileForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo $name; ?>" required>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required>
            <label>Age:</label>
            <input type="number" name="age" value="<?php echo $age; ?>" required>
            <label>Gender:</label>
            <input type="radio" name="gender" value="male" <?php if ($gender == 'male') echo "checked"; ?>> Male
            <input type="radio" name="gender" value="female" <?php if ($gender == 'female') echo "checked"; ?>> Female
            <input type="radio" name="gender" value="other" <?php if ($gender == 'other') echo "checked"; ?>> Other
            <label>Therapy Type:</label>
            <input type="text" name="therapy_type" value="<?php echo $therapyType; ?>" required>
            <label>WhatsApp:</label>
            <input type="tel" name="whatsapp" value="<?php echo $whatsapp; ?>" required>
            <label>Facebook:</label>
            <input type="text" name="facebook" value="<?php echo $facebook; ?>" required>
            <label>Experience:</label>
            <textarea name="experience" required><?php echo $experience; ?></textarea>
            <label>Quote:</label>
            <input type="text" name="quote" value="<?php echo $quote; ?>" required>
            <label for="">Create a New Password: <input type="password" name="password"/></label>
            <label for="">Confirm Password: <input type="password" name="confirm_password"/></label>
            <label>Profile Photo:</label>
            <input type="file" name="profile_photo">
            <input type="hidden" name="time_slots" id="time_slots" value="">
            <button type="submit">Update Profile</button>
            <script>
                function validatePassword() {
                    var password = document.getElementById("password")
                        , confirm_password = document.getElementById("confirm_password");
                    if(password.value != confirm_password.value) {
                        confirm_password.setCustomValidity("Passwords Don't Match");
                    } else {
                        confirm_password.setCustomValidity('');
                    }
                }
                document.getElementById("password").onchange = validatePassword;
            </script>
        </form>
        <button onclick="location.href='Profile.php'">Go back to Profile</button>
    </div>
</body>
</html>
