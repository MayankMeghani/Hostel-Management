<?php
session_start();
require  ('connection.php');

$querry= "SELECT * FROM `user_details` WHERE `Email` LIKE '$_SESSION[email]'";
$result=mysqli_query($link,$querry);
$data=mysqli_fetch_assoc($result);
$hostel=$data["Hostel Name"];
$querry= "SELECT * FROM `$hostel` WHERE `Email` LIKE '$_SESSION[email]'";
$result=mysqli_query($link,$querry);
$data=mysqli_fetch_assoc($result);
$querry1="SELECT * FROM `menu` WHERE `Hostel Name` LIKE '$hostel'";
$result1=mysqli_query($link,$querry1);
$data1=mysqli_fetch_assoc($result1);
$querry2="SELECT * FROM `announcements` WHERE `Hostel Name` LIKE '$hostel'";
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
	<a  href="http://localhost/phpt/project%20hw1/student.php">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Services</button>
		<div class="dropdown-content">
		  <a href="http://localhost/phpt/project%20hw1/signup.php">Registration for student</a>
		  <a href="http://localhost/phpt/project%20hw1/register_hostel.php">Registration for hostel</a>
		</div>
	</div>
    <a href="http://localhost/phpt/project%20hw1/menu.php">Menu</a>  
    <a href="http://localhost/phpt/project%20hw1/payments.php">Payments</a>
    <a href="http://localhost/phpt/project%20hw1/about_us1.php" class="active">About Us</a>  
    <a href="http://localhost/phpt/project%20hw1/feedback1.php" >Feedback</a>  
    <a id="navbar_l" class="active" href="http://localhost/phpt/project%20hw1/home_page.php">Logout</a> 
    
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
            $querry2="SELECT * FROM `announcements` WHERE `Hostel Name` LIKE '$hostel'";
            $result2=mysqli_query($link,$querry2);
            while($data2=mysqli_fetch_assoc($result2)){
                echo "<li>$data2[Announcements]</li>";
            } 
            ?>
      </ol>
  </div>

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
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Hostel Ratings & Management</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color:bisque;
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

    a {
      color: #007bff;
      text-decoration: none;
    }

  </style>
</head>
<body>
  <div class="container">
    <h1>About Us</h1>
    <p>Welcome to Hostel Ratings & Management!</p>
    <p>We are a platform designed to help students find the best hostels and provide hostel owners with a convenient way to manage their properties and communicate with their tenants.</p>
    <p>Our website allows students to review hostels they have stayed in, helping other students make informed decisions about their accommodation. Hostel owners can also use our platform to make important announcements and stay connected with their tenants.</p>
    <p>Whether you are a student looking for a great place to stay or a hostel owner looking to improve your services, Hostel Ratings & Management is here to assist you.</p>
    <p>At Hostel Ratings & Management, we prioritize the comfort and satisfaction of both students and hostel owners. Our goal is to create a seamless experience that benefits everyone involved in the hostel community.</p>
    <p>Thank you for choosing Hostel Ratings & Management. We hope you have a pleasant experience using our platform!</p>
    <p>If you have any questions or feedback, please don't hesitate to <a href="http://localhost/phpt/project%20hw1/feedback1.php">contact us</a>.</p>
  </div>
</body>
</html>
