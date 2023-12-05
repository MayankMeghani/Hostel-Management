<?php
session_start();
require  ('connection.php');

$querry= "SELECT * FROM `hostel_information` WHERE `Email` LIKE '$_SESSION[email]'";
$result=mysqli_query($link,$querry);
$data=mysqli_fetch_assoc($result);
$hostel=$data["Hostel Name"];
$_SESSION["Hostel"]=$hostel;
$querry= "SELECT * FROM `$hostel` WHERE 1";
$result=mysqli_query($link,$querry);

$querry1="SELECT * FROM `menu` WHERE `Hostel Name` LIKE '$hostel'";
$result1=mysqli_query($link,$querry1);
$data1=mysqli_fetch_assoc($result1);

$querry2="SELECT * FROM `announcements` WHERE `Hostel Name` LIKE '$hostel'";
$result2=mysqli_query($link,$querry2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Feedback Form in HTML Example </title>

    <meta name="author" content="Codeconvey" />
    
    <link rel="stylesheet" href="style.css">
	
</head>
<body>
   <h1 style="color:red;text-shadow: 100px;text-align: center;text-decoration: double;">Hostel4U</h1>  

		
<div class="navbar">
    <a style="padding:.2px"><img src="logo.png" width="50px" height="50px" style="background-color: white;"> </a>
      <a   href="hostel.php">Home</a>
      <div class="dropdown">
          <button class="dropbtn" style="font-family: 'Courier New', monospace;">Services</button>
          <div class="dropdown-content">
            <a href="http://localhost/phpt/project%20hw1/signup.php">Registration for student</a>
            <a href="http://localhost/phpt/project%20hw1/register_hostel.php">Registration for hostel</a>
          </div>
      </div>
      <a class="active" href="menu_hostel.php" class="active">Menu</a>  
      <a href="http://localhost/phpt/project%20hw1/payments_hostel.php">Payments</a>
    <a href="http://localhost/phpt/project%20hw1/announcement.php">Annoncement</a>
    <a href="http://localhost/phpt/project%20hw1/about_us2.php">About Us</a>  
    <a href="http://localhost/phpt/project%20hw1/feedback2.php">Feedback</a>
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
    <div id="paragraph">
  <h2>HELLO!!
  <?php
  echo $hostel;
  ?>
  </h2>
  <h2> Your hostel's today's Mess Menu:</h2>
  <table style="border: 1px solid; font-size:20px;">
  <th style="border: 1px solid;">Breakfast</th>
  <th style="border: 1px solid;">Lunch</th>
  <th style="border: 1px solid;">Dinner</th>
  <tr>
    <td style="border: 1px solid;"><?php echo $data1["Breakfast"]; ?></td>
    <td style="border: 1px solid;"><?php echo $data1["Lunch"]; ?></td>
    <td style="border: 1px solid;"><?php echo $data1["Dinner"]; ?></td>
  </tr>
  </table>

  <h2> Your hostel's tommorow's Mess Menu:</h2>

  </div> 
    <?php
    $breakfast=0;
    $lunch=0;
    $dinner=0;
    $feedback=0;
    $count=1;
    while($data=mysqli_fetch_assoc($result)){
    if($data['Breakfast']==1){$breakfast++;}
    if($data['Lunch']==1){$lunch++;}
    if($data['Dinner']==1){$dinner++;}
    if($data['Feedback']>=1){if($count==1){$feedback+=$data['Feedback'];}$count++; $feedback+=$data['Feedback'];}
    }
    ?>
  <table style="border: 1px solid; font-size:20px;">
  <tr>
    <th ></th>
    <th style="border: 1px solid;">menu</th>
    <th style="border: 1px solid;">no. of students</th>
  </tr>
  <tr>
    <td style="border: 1px solid;">Breakfast</td>
    <td style="border: 1px solid;"><?php echo $data1["Breakfast t"]; ?></td>
    <td style="border: 1px solid; text-align:center;"><?php echo $breakfast ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid;">Lunch</td>
    <td style="border: 1px solid;"><?php echo $data1["Lunch t"]; ?></td>
    <td style="border: 1px solid;text-align:center;"><?php echo $lunch ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid;">Dinner</td>
    <td style="border: 1px solid;"><?php echo $data1["Dinner t"]; ?></td>
    <td style="border: 1px solid;text-align:center;"><?php echo $dinner ?></td>
    </tr>  
  </table>
  <br>  
    <a href="http://localhost/phpt/project%20hw1/change_item.php"><button >Change Item</button></a>
    <a href="http://localhost/phpt/project%20hw1/update_menu.php"><button> Update Menu</button></a>
  <h2>Review given by your students is: <?php echo round($feedback/$count,2);?>/5</h2>
    
<br>

<div class="footer">
  <div class="main">
  <div id=dv1 style="margin:20px;" >
      <h3 style="text-align: left;">Customer Care</h3>
      
      <a href="feedback2.php" style="color:white">contact us</a>
      <br/>
     
      <a href="feedback2.php" style="color:white">Feedback</a>
      <br/>
      <a href="about_us2.php" style="color:white">about us</a>

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