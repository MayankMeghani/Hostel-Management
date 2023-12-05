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
	<a  href="home_page.php" class="active">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Services</button>
		<div class="dropdown-content">
		  <a href="http://localhost/phpt/project%20hw1/signup.php">Registration for student</a>
		  <a href="http://localhost/phpt/project%20hw1/register_hostel.php">Registration for hostel</a>
		</div>
	</div>
    <a href="http://localhost/phpt/project%20hw1/about_us.php">About Us</a>  
    <a href="http://localhost/phpt/project%20hw1/feedback.php">Feedback</a>
    
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


  <div id="paragraph">
  <p style="font-size: 28px;">HELLO!!</p>
  <p style="font-size: 25px;">We are a hostel managment system.We are here to help you.<br>
With us you can manage your hostel easily.You can register your hostel with us.<br>
  After that your problem related to MESS MENU,LIGHT BILL,FEES REMINDER etc. are ours.
  </p>
  <br><br><br><br>
  <br><br>
</div>
<div class="footer">
  <div class="main">
  <div id=dv1 style="margin:20px;" >
      <h3 style="text-align: left;">Customer Care</h3>
      
      <a href="feedback.php" style="color:white">contact us</a>
      <br/>
     
      <a href="feedback.php" style="color:white">Feedback</a>
      <br/>
      <a href="about_us.php" style="color:white">about us</a>

      </h5>
      <br/>


  </div>
  <div id=dv2 style="margin:20px;">
     <h3>My account</h3>
     <a href="login_page.php" style="color:white">Login</a>
         <br/>

    <a href="signup.php" style="color:white">signup</a>
     
 </div> 
 <div id=dv5>
     <h3>Contact us</h3>
     <h5 style="padding:1px;">Mo. +91 987654321
         <br/>

     E-mail: example@gmail.com</h5>
     
 </div> 
 </div>

 <p >Copyright 2005-2023 by Refsnes Data. All Rights Reserved.
     Hostel4U.com is Powered by Hostel</p>
     <img src="logo.png"  Style="height:100px; width:100px; background-color: white; ">
 
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