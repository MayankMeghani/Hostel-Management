<?php
session_start();
$flag = TRUE;
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (empty($_POST['name'])) {
    $errors['name'] = "Please enter the name";
    $flag = FALSE;
  }

  if (empty($_POST['email'])) {
    $errors['email'] = "Please enter the email";
    $flag = FALSE;
  }

  $_SESSION['flag'] = $flag;
}
?>
<?php

$y = $_SESSION['CAPTCHA_CODE'];
    

  if(isset($_POST['submit'])){
       $captcha= $_POST['captcha'];
    if(isset($_POST['captcha'])){
        if(empty($captcha)){
        echo "<h1>Please Enter the captcha code</h1>";
    }

        else if($captcha != $y){
             echo "<h1>Invalid Captcha</h1>";

    }
    else {
        echo "<h1>Captcha Verified Succesfully.</h1>";
    }
  }
}
require_once "connection.php";
$all_info=array("hostel","name","room_type","room_no","mobile_no","email","password");
$general_info=array("name","room_type","room_no","mobile_no","email");
$user_deatil=array("email","password","hostel");
$hostels=[];
$inputs=[];
$i=0;

  if(isset($_POST['submit'])){

    foreach($all_info as $value){ 
      $inputs[$value]=$_POST[$value];
      }
    
      $hostel_count=0;
      $sql="SELECT * FROM `hostel_information`";
      $result=mysqli_query($link,$sql);
      while($row= mysqli_fetch_assoc($result)){
      $hostels[$hostel_count++]=$row["Hostel Name"];
      }
      foreach($inputs as $value){ 
        if(empty($value) || ctype_space($value)){
          echo "<h1>Please enter all details.</h1>";
          $i=1;
          break;
        }
      }

      if($i==0){
      $sql="INSERT INTO `user_details` ( `Email`, `Password`, `Hostel Name`, `Full Name`) VALUES ( '$inputs[email]', '$inputs[password]', '$inputs[hostel]', '$inputs[name]')";
        $result=mysqli_query($link,$sql);
        
      foreach($hostels as $value){
        if($_POST['hostel']==$value){
                $sql="INSERT INTO `$value` (`Full Name`,`Room Type`, `Room No.`, `Mobile No.`, `Email`) VALUE('$inputs[name]','$inputs[room_type]','$inputs[room_no]','$inputs[mobile_no]','$inputs[email]')";
                $result=mysqli_query($link,$sql);
              break;
            }
        }
                echo "<script>
                alert('Now you can Login with your Email and  password.');
                document.location='login_page.php';
                </script>";
      }
  }
?>
<html>
<head>
  <title>Student Signup</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }

    .login-container {
      max-width: 600px;
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
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .login-container .div8 label {
      display: inline-block;
      margin-right: 10px;
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

    .room-type-container label {
      display: inline-block;
      margin-right: 10px;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h1>Student Signup</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <div id="div1">
        <label>Select Hostel:</label>
        <select name="hostel">
          <?php
          require_once "connection.php";
          $hostels = array();
          $hostel_count = 0;
          $sql = "SELECT * FROM `hostel_information`";
          $result = mysqli_query($link, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            $hostels[$hostel_count++] = $row["Hostel Name"];
          }
          foreach ($hostels as $value) {
            echo "<option>$value</option>";
          }
          ?>
        </select>
      </div>
      <br>
<label>Full Name:</label>
<input type="text" id="name" name="name" value="<?php echo $inputs['name'] ?? ''; ?>"/>
      <br>
      <div class="room-type-container">
        <label>Room Type:</label>
        <input type="radio" name="room_type" id="NON-AC" value="NON-AC ROOM" checked>
        <label for="NON-AC">NON-AC ROOM</label>
        <input type="radio" name="room_type" id="AC" value="AC ROOM">
        <label for="AC">AC ROOM</label>
        <input type="radio" name="room_type" id="PERSONAL" value="PERSONAL ROOM">
        <label for="PERSONAL">PERSONAL ROOM</label>
      </div>
      <br>
      <label>Room No.:</label>
      <input type="text" id="room_no" name="room_no" value="<?php echo $inputs['room_no'] ?? ''; ?>" /><br><br>
      <label>Mobile No.:</label>
      <input type="text" id="mobile_no" name="mobile_no" value="<?php echo $inputs['mobile_no'] ?? ''; ?>" /><br><br>
      <label>Email:</label>
      <input type="email" id="email" name="email" value="<?php echo $inputs['email'] ?? ''; ?>" />
      <small><?php echo $errors['email'] ?? ''; ?></small><br><br>
      <label>Password:</label>
      <input type="password" id="password" name="password"><br><br>
      <label id="captcha">Enter Captcha:</label>
      <input type="text" id="captcha" name="captcha">
      <br><br>
      Captcha Code:
      <img src="c.php">
      <button id="reload-captcha" onclick="location.reload()"> <img src="OIP.jpeg" width="20px" height="20px"></button>
      <br><br>
      <input type="submit" name="submit" value="Register">
    </form>
    <a class="signup-link" href="login_page.php">Login as a Student</a>
  </div>
</body>
</html>
