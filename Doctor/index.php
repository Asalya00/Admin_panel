<?php
session_start();
// Turn off PHP warnings
error_reporting(E_ERROR | E_PARSE);
// Check if the user is logged in
if (isset($_SESSION['LogedIn']) || $_SESSION['LogedIn'] === TRUE) {
header('Location: Profile.php');
error_reporting(E_ALL);
exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>Login / Signup</title>
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
      <link rel="stylesheet" href="index.css">
  </head>
  
  <body>
    <div class="container" id="container">
      
      <div class="form-container sign-up-container">
        <form action="signup.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <label for="">Enter Your Name: <input type="text" name="name" required/></label>
                <label for="">Enter Your Email: <input type="email" name="email" required/></label>
                <label for="">Create a New Password: <input type="password" name="password" required/></label>
            </fieldset>
            <fieldset>
              <label for="">Upload Profile Photo: <input type="file" name="profile_photo" id ="profile_photo" accept="image/*" required/></label>
          </fieldset>
            <fieldset>
                <label>
                    <input type="checkbox" name="terms" class="inline" required /> I accept the
                        <a href = "../terms/index.html">terms and conditions</a>
                </label>
            </fieldset>
     <button>Sign Up</button>
    </form>
    </div>
      
    <div class="form-container sign-in-container">
       <form action="login.php" method="post">
   <h1 id="title">Sign in</h1>
   <span>Use your account</span>
   <label for="email" id="email-label">
        <input type="email" id="email" placeholder="Email" name="email" required /></label>
      <label for="password" id="password-label">
      <input type="password" id="password" placeholder="Password" name="password" required /></label>
   <button>Sign In</button>
  </form>
    </div>
      
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1 id="title">Welcome!</h1>
    <p>Login with your personal info</p>
    <button class="ghost" id="signIn">Sign In</button>
          </div>
          
          <div class="overlay-panel overlay-right">
            <h1 id="title">Hello!</h1>
    <p>Enter your personal details and start</p>
    <button class="ghost" id="signUp">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
    <script>

    </script>
    <script src="js.js"></script>
  </body>
</html>
