<?php

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $formData = $_POST;

    // Save the form data to the database
$conn = new mysqli('localhost', 'root', '', 'counsellingapp');

$id = (int)$_POST['id'];
$name = $_POST['name'];
$age = (int)$_POST['age'];
$email = $_POST['email'];
$role = $_POST['role'];
$diplomadegree = $_POST['diplomadegree'];
$university = $_POST['university'];
$yearsfordegree = (int)$_POST['yearsfordegree'];
$speciality = implode(', ',$_POST['speciality']);
$qualifications = $_POST['qualifications'];
$counsellor = $_POST['counsellor'];
$counsellortrainyears = (int)$_POST['counsellortrainyears'];
$psychiatrist = $_POST['psychiatrist'];
$psychiatristtrainyears = (int)$_POST['psychiatristtrainyears'];
$experience = $_POST['experience'];

    if ($conn->connect_error) {
        die('connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO therapistquiz (id, name, age, email, role, diplomadegree, university, yearsfordegree, speciality, qualifications, counsellor, counsellortrainyears, psychiatrist, psychiatristtrainyears, experience) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isissssisssisis", $id, $name, $age, $email, $role, $diplomadegree, $university, $yearsfordegree, $speciality, $qualifications, $counsellor, $counsellortrainyears, $psychiatrist, $psychiatristtrainyears, $experience);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}
?>










