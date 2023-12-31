<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $enteredPassword = $_POST['password']; // Getting the plain entered password

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);
      $storedHashedPassword = $row['password']; // Fetch the stored hashed password

      if(password_verify($enteredPassword, $storedHashedPassword)){
         // Password is correct
         if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
         } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      } else {
         // Password is incorrect
         $message[] = 'Incorrect Email Address or Password!';
      }
   } else {
      $message[] = 'User not found';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="https://github.com/bibekgurung9" target="_blank" class="fab fa-github"></a>
            <a href="https://www.linkedin.com/in/bibek-gurung-4aa280274/" target="_blank" class="fab fa-linkedin"></a>
            <a href="#" class="fab fa-instagram"></a>
            
         </div>
         <p><a href="login.php">Login </a> | <a href="register.php">Register</a> </p>
      </div>
   </div>
</header>

<div class="welcome">
<h3>Welcome to BIKESHOP</h3>
<p>Login Into Your Account: </p>
</div>
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="Enter Your Email" required class="box">
      <input type="password" name="password" placeholder="Enter Your Password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
      <p>Don't have an account? <a href="register.php">Register Now!</a></p>
   </form>
</div>

<section class="footer">
   <div class="box-container">
      <div class="box">
         <h3>extra links</h3>
         <a href="login.php">LOGIN</a>
         <a href="register.php">REGISTER</a>
         <a href="https://github.com/bibekgurung9" target="_blank">GITHUB</a>
         <a href="https://www.linkedin.com/in/bibek-gurung-4aa280274/" target="_blank">LINKEDIN</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> +977-98XXXXXXXX</p>
         <p> <i class="fas fa-phone"></i> +144-XXXXXX </p>
         <p> <i class="fas fa-envelope"></i> bibekgurung@email.com </p>
         <p> <i class="fas fa-map-marker-alt"></i> Kathmandu, Nepal</p>
      </div>

      <div class="box">
         <h3>Our Location</h3>
         <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d56510.204945783196!2d85.33448653535157!3d27.72075003156448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1692882526915!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
   </div>

   <p class="credit"><span>BCA 4th Semester Project</span><br>
   <span>@ All Rights Reserved To Bibek Gurung & Jebin Joshi</span> </p>

</section>
</body>
</html>