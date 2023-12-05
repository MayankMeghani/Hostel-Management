<?php
session_start();
require "connection.php";

$mail = NULL;

$y = $_SESSION['CAPTCHA_CODE'];
   
$flag=TRUE;
     
if (isset($_POST["submit"])) {

    $captcha= $_POST['captcha'];
    if(isset($_POST['captcha'])){
        if(empty($captcha)){
        echo "<h1>Please Enter the captcha code</h1>";
        $flag=FALSE;
    }

        else if($captcha != $y){
             echo "<h1>Invalid Captcha</h1>";
             $flag=FALSE;

    }
    else {
        echo "<h1>Captcha Verified Succesfully.</h1>";
    }
}
    $mail=$_POST["email"];
    $psw=$_POST["password"];
    if (!empty($_POST["email"]) and !empty($_POST["password"]) ) {
        $sql="SELECT `Hostel Name` FROM `user_details` WHERE `Email`='$mail' AND `Password`='$psw' ";
        $result=mysqli_query($link,$sql);
        $row=mysqli_fetch_assoc($result);
        if($row>0 && $flag){
            $hostel=$row['Hostel Name'];
            $_SESSION["email"]=$mail;
            $email=$mail;
            header('location: http://localhost/phpt/project%20hw1/student.php');
            die;
        }
        else{
            $sql1="SELECT * FROM `user_details` WHERE `Email`='$mail'";
            $result1=mysqli_query($link,$sql1);
            $row1=mysqli_fetch_assoc($result1);
            if($row1>0 ){                
                echo "<h1>Password is incorrect.</h1>";
                }
            else{
                echo "<h1>Email ID not registered.</h1>";
                }
        }
    }
    else{
      echo "<h1>Please enter email and password.</h1>";
    }
}
?>
   
 
<!DOCTYPE html>
<html>
<head>
  <title>Login Page with Captcha</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }

    .login-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h1 {
      font-size: 24px;
      text-align: center;
      margin-bottom: 20px;
    }

    .login-container label {
      display: block;
      margin-bottom: 10px;
    }

    .login-container input[type="email"],
    .login-container input[type="password"],
    .login-container input[type="text"] {
      width: 80%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .login-container .captcha-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .login-container .captcha-container img {
      display: inline-block;
      vertical-align: middle;
    }

    .login-container .captcha-container button {
      display: inline-block;
      vertical-align: middle;
      margin-left: 10px;
      background-color: transparent;
      border: none;
      cursor: pointer;
    }

    .login-container input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .login-container .signup-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #333;
      text-decoration: none;
    }

    .login-container .signup-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
<form action="<?php echo $_SERVER["PHP_SELF"];?> " method="post" >
    <h1>Login</h1>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <div class="captcha-container">
        <label for="captcha">Enter Captcha</label>
        <input type="text" id="captcha" name="captcha" required>
        <img src="c.php" alt="Captcha Image">
        <img src="OIP.jpeg" onclick="location.reload()" width=20px height=20px>
      </div>

      <input type="submit" name="submit" value="Submit">

      <a class="signup-link" href="signup.php">New user? Sign up</a>
      <a class="signup-link" href="hostel_login.php">Login as a Hostel</a>
    </form>
  </div>
</body>
</html>
