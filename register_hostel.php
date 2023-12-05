<?php
session_start();
$flag=TRUE;
if($_SERVER['REQUEST_METHOD'] == "POST"){
if(empty($_POST['owner_name'])){
  $errors['owner_name'] = "Please enter the name";
 $flag=FALSE;
}
if(empty($_POST['email'])){
  $errors['email']="Please enter the email";
 
  $flag = FALSE;
}
if(empty($_POST['hostel_name'])){
  $errors['hostel_name']="Please enter Hostel Name";
  $flag = FALSE;
}
$_SESSION['flag']=$flag;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Registration for Hostel</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
      }

      h1 {
        color: #333;
        text-align: center;
      }

      form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        max-width: 500px;
        margin: 0 auto;
      }

      label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
      }

      input[type="text"],
      input[type="password"],
      input[type="email"],
      textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 14px;
      }

      input[type="file"] {
        margin-top: 5px;
      }

      input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 16px;
      }

      input[type="submit"]:hover {
        background-color: #45a049;
      }

      small {
        color: red;
      }

      #div1 {
        margin-bottom: 10px;
      }

      #div3 {
        margin-top: 20px;
        display: block;
        width: 100%;
      }

      #div4 {
        margin-top: 0;
      }

      #captcha {
        display: inline-block;
        margin-bottom: 10px;
      }

      #captcha input[type="text"] {
        width: 150px;
      }
    </style>
  </head>

  <body>
    <h1 id="div4">Register Your Hostel</h1>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
      <div id="div1">
        <label>Hostel Name:</label>
        <input type="text" id="hostel_name" name="hostel_name" value="<?php echo $inputs['name'] ?? ''; ?>" placeholder="Hostel Name" />
        <small><?php echo $errors['hostel_name'] ?? ''; ?></small>
      </div>

      <div id="div1">
        <label>Owner Name:</label>
        <input type="text" id="owner_name" name="owner_name" value="<?php echo $inputs['name'] ?? ''; ?>" placeholder="Owner Name" />
        <small><?php echo $errors['owner_name'] ?? ''; ?></small>
      </div>

      <div id="div1">
        <label>Owner's Mobile No.:</label>
        <input type="text" id="owner_no" name="owner_no" value="<?php echo $inputs['owner_no'] ?? ''; ?>" placeholder="Owner Mobile No." />
      </div>

      <div id="div1">
        <label>Hostel license:</label>
        <input type="file" id="license" name="fileUpload" value="<?php echo $inputs['license'] ?? ''; ?>" required />
      </div>

      <div id="div1">
        <label>Manager Name:</label>
        <input type="text" id="manager_name" name="manager_name" value="<?php echo $inputs['manager_name'] ?? ''; ?>" placeholder="Manager Name" />
      </div>

      <div id="div1">
        <label>Manager's Mobile No.:</label>
        <input type="text" id="manager_no" name="manager_no" value="<?php echo $inputs['manager_no'] ?? ''; ?>" placeholder="Manager Mobile No." />
      </div>

      <div id="div1">
        <label>NON-AC ROOM'S FEES:</label>
        <input type="text" id="f_nac_rooms" name="f_nac_rooms" value="<?php echo $inputs['f_nac_rooms'] ?? ''; ?>" placeholder="Non AC fees" />
      </div>

      <div id="div1">
        <label>AC ROOM'S FEES:</label>
        <input type="text" id="f_ac_rooms" name="f_ac_rooms" value="<?php echo $inputs['f_ac_rooms'] ?? ''; ?>" placeholder="AC fees" />
      </div>

      <div id="div1">
        <label>PERSONAL ROOM'S FEES:</label>
        <input type="text" id="f_personal_rooms" name="f_personal_rooms" value="<?php echo $inputs['f_personal_rooms'] ?? ''; ?>" placeholder="Personal room fees" />
      </div>

      <div id="div1">
        <label>Address:</label>
        <textarea id="address" name="address" placeholder="Address" style="height: 80px;"><?php echo $inputs['address'] ?? ''; ?></textarea>
      </div>

      <div id="div1">
        <label>Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $inputs['email'] ?? ''; ?>" placeholder="Email-ID" />
        <small><?php echo $errors['email'] ?? ''; ?></small>
      </div>

      <div id="div1">
        <label>Password:</label>
        <input type="password" id="password" name="password" />
      </div>

      <div id="div1">
        <label id="captcha">Enter Captcha:</label>
        <input type="text" id="captcha" name="captcha" />
      </div>

      <div id="div1">
        Captcha Code:
        <img src="c.php" />
        <button id="r" onclick="c.php">
          <img src="OIP.jpeg" width="20px" height="20px" />
        </button>
      </div>
      
      <input type="submit" name="submit" value="Register" id="div3">
    
      <a class="signup-link" href="hostel_login.php">Login as a Hostel</a>
    </form>
    <?php
    
require_once "connection.php";
$all_info=array("hostel_name","owner_name","owner_no","manager_name","manager_no","f_nac_rooms","f_ac_rooms","f_personal_rooms","address","email","password");
$general_info=array("hostel_name","owner_name","owner_no","manager_name","manager_no","f_nac_rooms","f_ac_rooms","f_personal_rooms","address","email");
$user_deatil=array("email","password","hostel");
$inputs=[];


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
    $i=0;
    foreach($all_info as $value){ 
      $inputs[$value]=$_POST[$value];
      }
      

    foreach($inputs as $value){ 
      if(empty($value) || ctype_space($value)){
        echo "<h1>Please enter all details.</h1>";
        $i=1;
        break;
        }
      }
      $checkuser ="SELECT * from hostel_information where `Hostel Name`= '$inputs[hostel_name]'";
      $result =mysqli_query($link,$checkuser);
      $count=mysqli_num_rows($result);
     
      if($count>0 ){
          echo "DUPLICATE ELEMENT";
      }

     
     

    if($i==0 && $count==0 ){
      $fileName = $_FILES['fileUpload']['name'];
    $sql="INSERT INTO `hostel_information` (`Hostel Name`, `Owner Name`, `Owner's No.`, `Manager Name`, `Manager No.`,`NON-AC ROOM`, `AC ROOM`, `PERSONAL ROOM`, `Address`, `Email`,`Password`,`license`) VALUES ( '$inputs[hostel_name]', '$inputs[owner_name]', '$inputs[owner_no]', '$inputs[manager_name]', '$inputs[manager_no]', '$inputs[f_nac_rooms]', '$inputs[f_ac_rooms]', '$inputs[f_personal_rooms]', '$inputs[address]', '$inputs[email]','$inputs[password]','$fileName')";
   $result=mysqli_query($link,$sql); 
   move_uploaded_file($_FILES['fileUpload']['tmp_name'],'license/'.$fileName);   

    $sql="CREATE TABLE `$inputs[hostel_name]` (`G.R. No.` INT NOT NULL AUTO_INCREMENT , `Full Name` VARCHAR(30) NOT NULL , `Room Type` VARCHAR(20) NOT NULL , `Room No.` VARCHAR(15) NOT NULL , `Mobile No.` VARCHAR(15) NOT NULL , `Email` VARCHAR(30) NOT NULL , `Fees` BOOLEAN NOT NULL , `Light Bill` INT NOT NULL , `Light Bill Status` BOOLEAN NOT NULL ,  `Breakfast` tinyint(1) NULL,  `Lunch` tinyint(1) NULL,  `Dinner` tinyint(1) NULL,  `Feedback` int(11) NOT NULL, PRIMARY KEY (`G.R. No.`))";
        $result=mysqli_query($link,$sql);
        
    $sql="INSERT INTO `menu` (`Hostel Name`) VALUES ('$inputs[hostel_name]')";
    $result=mysqli_query($link,$sql);          
      echo "<script>
                alert('Now you can Login with your Email and  password.');
                document.location='login_page.php';
                </script>";
               }
    }
  }
?>
  </body>
</html>
