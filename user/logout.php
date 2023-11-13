<?php
session_start();

if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] === true) {
    session_unset();
    session_destroy();
}

header('Location: login.php');
exit;
?>
