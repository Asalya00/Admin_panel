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
        // register
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $conn = new mysqli('localhost','root','','counsellingapp');
        if($conn->connect_error){
            die('connection Failed :' .$conn->connect_error);
        } else{
            $sql= "SELECT id FROM users WHERE Email='$email' ORDER BY id DESC LIMIT 1;";
        
            $result = mysqli_query($conn,$sql);
        
            $row = mysqli_fetch_array($result);
        
            if ($row != Null) {
                echo "A user with the given email already exists";
                echo '<a href="index.php" class="redirect-button">Go Back</a>';
            } else {
        
                $sql= "SELECT id FROM users ORDER BY id DESC LIMIT 1;";

                $result = mysqli_query($conn,$sql);

                $row = mysqli_fetch_array($result);

                $uid=(int)$row['id']+1;

                if (isset($_FILES["profile_photo"])) {
                    $targetDir = "uploads/";
                    $imageFileType = strtolower(pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION));

                    // Generate a unique filename
                    $Filename = sprintf("%'.010d", $uid) . "Doctor" . $imageFileType;
                    $targetFile = $targetDir . $Filename;

                    $uploadOk = 1;

                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }

                    // Check if file already exists
                    if (file_exists($targetFile)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif") {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFile)) {
                            //echo "The file " . basename($_FILES["profile_photo"]["name"]) . " has been uploaded.";

                            // Insert image location into the database
                            $imageLocation = $targetFile;
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }


                $sql = "INSERT INTO users (id, name, email, password, profile_photo)
                        VALUES ('".sprintf("%'.010d", $uid)."','$name','$email','".md5($password)."','".$imageLocation."')";
                if ($conn->query($sql) === TRUE){
                    echo"Registration Complete You can login using your username and password";
                    sleep(10);
                    header('Location: ./index.php');
                }
            }
        }
        // Display messages
        if (isset($message)) {
            echo '<p class="message">' . $message . '</p>';
        }
        ?>
    </div>
</body>
</html>
