<?php


$server='localhost';
$user='root';
$pass='';
$db='hostel';

$conn=mysqli_connect($server,$user,$pass,$db);

if($conn){

}
else{
  echo "Could not connect to server.";
}
$flag=TRUE;
if($_SERVER['REQUEST_METHOD'] == "POST"){

  if(empty($_POST['name'])){
      $errors['name'] = "Please enter the name";
      
     $flag=FALSE;
  }
  if(empty($_POST['email'])){
      $errors['email']="Please enter the email";
     
      $flag = FALSE;
  }
  if(empty($_POST['message'])){
      $errors['message']="Please enter message";
      $flag = FALSE;
  }

  if(isset($_POST['submit']) && $flag){
      $name = $_POST['name'];
      
      $email = $_POST['email'];
      $message = $_POST['message'];
     
    }
    if($flag!=FALSE){
     $sql= "INSERT INTO feedback(`Name`,`Email`,`Message`) values ('$name', '$email', '$message')";
     mysqli_query($conn,$sql);
    }
  }
  


?>
<?php

require  ('connection.php');
$querry2="SELECT * FROM `announcements` WHERE 1";
$result2=mysqli_query($link,$querry2);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="theme.css">
</head>
<body>
   <h1 style="color:red;text-shadow: 100px;text-align: center;text-decoration: double;">Hostel4U</h1>  

<div class="navbar">
  <a style="padding:.2px"><img src="logo.png" width="50px" height="50px" style="background-color: white;"> </a>
	<a  href="home_page.php">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Services</button>
		<div class="dropdown-content">
		  <a href="http://localhost/phpt/project%20hw1/signup.php">Registration for student</a>
		  <a href="http://localhost/phpt/project%20hw1/register_hostel.php">Registration for hostel</a>
		</div>
	</div>
    <a href="http://localhost/phpt/project%20hw1/about_us.php">About Us</a>  
    <a href="http://localhost/phpt/project%20hw1/feedback.php" class="active">Feedback</a>
    
    <a id="navbar_l" class="active" href="http://localhost/phpt/project%20hw1/login_page.php">Login</a> 
    <?php
      $announcement=0;
            while($data2=mysqli_fetch_assoc($result2)){
                $announcement++;
            } 
    ?>
<a onclick="myFunction()" class="notification" id="navbar_l"><img src="download.png"width="25px" height="25px"style="border-radius:15px"><span class="badge"><?php echo $announcement;?></span></a>
</div>


  <div id="div7" style="display: none">
    <h2 style="text-align: center; color:blue;">Annoncements</h2>
   
    <ol>
            <?php
            $querry2="SELECT * FROM `announcements` WHERE 1";
            $result2=mysqli_query($link,$querry2);
            while($data2=mysqli_fetch_assoc($result2)){
                echo "<li>$data2[Announcements]</li>";
            } 
            ?>
      </ol>
  </div>
</body>
</html>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Hostel Ratings & Management</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f1f1f1;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
      margin-bottom: 20px;
      text-align: center;
    }

    p {
      color: #555;
      line-height: 1.6;
      margin-bottom: 10px;
    }

    form {
      margin-top: 20px;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    textarea {
      height: 120px;
    }

    button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Feedback Form</h1>
    <p>If you have any feedback, questions, or inquiries, please feel free to reach out to us using the form below. We'll get back to you as soon as possible.</p>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"  enctype="multipart/form-data">
      <input type="text" placeholder="Your Name" name="name" required>
      <input type="email" placeholder="Your Email" name="email" required>
      <textarea placeholder="Your Message" name="message" required></textarea>
      <button type="submit" name="submit">Send Message</button>
    </form>
  </div>
</body>
</html>
<script>
  function myFunction() {
    var x = document.getElementById("div7");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>