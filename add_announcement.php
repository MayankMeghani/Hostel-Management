<?php
session_start();
require_once "connection.php";
$hostel=$_SESSION["Hostel"];
?>
<form action="<?php echo $_SERVER["PHP_SELF"];?> " method="post" >

<label>Annoncement:</label>
<textarea name="announcement"  placeholder="announcement"></textarea><br><br>
<input type="submit"  name="submit" value="Submit" >
</form>
<a href="http://localhost/phpt/project%20hw1/announcement.php"><button>Back to announcement</button></a>
<?php
if(isset($_POST['submit'])){
$querry="INSERT INTO `announcements` (`Announcements`, `Hostel Name`) VALUES ('$_POST[announcement]', '$hostel')";
$result=mysqli_query($link,$querry);
}
?>