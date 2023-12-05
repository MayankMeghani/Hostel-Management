<?php
session_start();
require  ('connection.php');

$querry= "SELECT * FROM `hostel_information` WHERE `Email` LIKE '$_SESSION[email]'";
$result=mysqli_query($link,$querry);
$data=mysqli_fetch_assoc($result);
$hostel=$data["Hostel Name"];
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
<body style="background-color: rgb(255, 193, 118);">
   <h1 style="color:red;text-shadow: 100px;text-align: center;text-decoration: double;">Hostel4U</h1>  

<div class="navbar">
  <a style="padding:.2px"><img src="logo.png" width="50px" height="50px" style="background-color: white;"> </a>
	<a  href="http://localhost/phpt/project%20hw1/hostel.php">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Services</button>
		<div class="dropdown-content">
		  <a href="http://localhost/phpt/project%20hw1/signup.php">Registration for student</a>
		  <a href="http://localhost/phpt/project%20hw1/register_hostel.php">Registration for hostel</a>
		</div>
	</div>
    <a href="http://localhost/phpt/project%20hw1/menu_hostel.php">Menu</a>  
    <a href="http://localhost/phpt/project%20hw1/payments_hostel.php" class="active">Payments</a>
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
  <h3>Manage light bill:</h3>
<form action="<?php echo $_SERVER["PHP_SELF"];?> " method="post">
<label>Room no.</label>
<select name="room" >
<?php
session_start();
require  ('connection.php');
$hostel=$_SESSION["Hostel"];
$querry= "SELECT * FROM `$hostel` WHERE 1";
$result=mysqli_query($link,$querry);
while($data=mysqli_fetch_assoc($result)){
    $d=$data["Room No."];
    echo "<option >$d</option>";
    }
?>
</select>
<br><br>
<label>Bill amount:</label>
<input type="text" name="amount" value="<?php echo $inputs['amount'] ?? ''; ?>"/>
<br><br>
<label>Bill status:</label>
Paid
<input type="radio" value="1" name="status"/>
Unpaid
<input type="radio" value="0" name="status" checked/>
<br><br>
<input type="submit"  name="submit" value="Submit" >
</form>

<?php
$count=0;
$info=array("amount","status");
if(isset($_POST['submit'])){
    foreach($info as $value){ 
        if(empty($_POST[$value]) || ctype_space($_POST[$value])){
            echo "<h1>Please enter all details.</h1>";
            $count++;
            break;
        }
        if($count==0){
            $querry1="UPDATE `$hostel` SET `Light Bill`='$_POST[amount]',`Light Bill Status`='$_POST[status]' WHERE `Room No.`=$_POST[room]";
            $result1=mysqli_query($link,$querry1);
        }
    }
}
?>

<h3>Manage Fees:</h3>
<form action="<?php echo $_SERVER["PHP_SELF"];?> " method="post">
<label>Enter GR No.</label>
<input type="text" name="gr" value="<?php echo $_POST['gr'] ?? ''; ?>"/>
<input type="submit" name="submit1" value="Fetch Details" onclick="myFunction1(event)">

</form>
<?php
        if (isset($_POST['submit1'])) {
            if (empty($_POST['gr']) || ctype_space($_POST['gr'])) {
                echo "<h3>Please enter GR NO.</h3>";
                $data++;
            } else {
                $querry2 = "SELECT * FROM `$hostel` WHERE `G.R. No.`=$_POST[gr]";
                $result = mysqli_query($link, $querry2);
                $data = mysqli_fetch_assoc($result);
            }
            if ($data == 0) {
                echo "<h3>Enter valid GR No.</h3>";
            }
            $_SESSION["gr"] = $_POST['gr'];
        }
        ?>
<div id="div8">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <br>
        <label>Name:</label>
        <input type="text" name="amount" value="<?php echo $data["Full Name"] ?? ''; ?>" readonly/>
        <br><br>
        <label>Room Type:</label>
        <input type="text" name="amount" value="<?php echo $data["Room Type"] ?? ''; ?>" readonly/>
        <br><br>
        <label>Bill status:</label>
        Paid
        <input type="radio" value="1" name="status1"/>
        Unpaid
        <input type="radio" value="0" name="status1" checked/>
        <br><br>
        <input type="submit" name="submit2" value="Submit">
        
</form>
</div>


<?php
if(isset($_POST['submit2'])){
    $querry3="UPDATE `$hostel` SET `Fees`='$_POST[status1]' WHERE `G.R. No.`= $_SESSION[gr]";
    $result=mysqli_query($link,$querry3);
}
?>
<br><br>

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
<script>
  function myFunction1() {
    var x = document.getElementById("div8");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>


</body>
</html>
