<?php
session_start();
require_once "connection.php";
$hostel=$_SESSION['Hostel'];
$querry="SELECT * FROM `menu` WHERE `Hostel Name` LIKE '$hostel'";
$result=mysqli_query($link,$querry);
$data=mysqli_fetch_assoc($result);
?>
<h2>You can change any of the item by submitting this form</h2>
<form action="<?php echo $_SERVER["PHP_SELF"];?> " method="post" >
<label >Breakfast:</label>
<textarea  name="Breakfast" placeholder="<?php echo $data['Breakfast t'] ?? ''; ?>"></textarea><br><br>
<label >Lunch:</label>
<textarea name="Lunch" placeholder="<?php echo $data['Lunch t'] ?? ''; ?>"></textarea><br><br>
<label >Dinner:</label>
<textarea name="Dinner" placeholder="<?php echo $data['Dinner t'] ?? ''; ?>"></textarea><br><br>

</label>
<input type="submit"  name="submit" value="Submit" >
<br>
</form>
<a href="http://localhost/phpt/project%20hw1/menu_hostel.php"><button>Back to menu</button></a>

<?php
$info=array("Breakfast","Lunch","Dinner");
$inputs=[];
if(isset($_POST['submit'])){
    foreach($info as $value){ 
        if(empty($_POST[$value]) || ctype_space($_POST[$value])){}
        else{
            $d=$data["$value t"];
            $querry1="UPDATE `menu` SET `$value t`='$_POST[$value]' WHERE `$value t` LIKE '$d'";
            $result=mysqli_query($link,$querry1);
            
        }
    }
}
?>