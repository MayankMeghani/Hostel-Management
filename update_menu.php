<?php
session_start();
require_once "connection.php";
$hostel=$_SESSION['Hostel'];
$querry="SELECT * FROM `menu` WHERE `Hostel Name` LIKE '$hostel'";
$result=mysqli_query($link,$querry);
$data=mysqli_fetch_assoc($result);
?>

<?php
$info=array("Breakfast","Lunch","Dinner");
$inputs=[];
$count=0;
if(isset($_POST['submit'])){
    foreach($info as $value){ 
    $inputs[$value]=$_POST[$value];
    }
    foreach($info as $value){ 
        if(empty($_POST[$value]) || ctype_space($_POST[$value])){
            $count++;
        }
    }
    if($count==0){
        foreach($info as $value){
        $d=$data["$value t"];
        $querry1="UPDATE `menu` SET `$value`='$d' WHERE `$value` LIKE '$data[$value]'";
        $result=mysqli_query($link,$querry1);
        $querry1="UPDATE `menu` SET `$value t`='$_POST[$value]' WHERE `$value t` LIKE '$d'";
        $result=mysqli_query($link,$querry1);
        $querry1="UPDATE `$hostel` SET `$value`='0' WHERE 1";
        $result=mysqli_query($link,$querry1);
        }
        
        $querry1="UPDATE `$hostel` SET `Feedback`='0' WHERE 1";
        $result=mysqli_query($link,$querry1);
    }
    else{
        echo "<h2>Please fill all section.</h2>";
    }
}
?>
<h2>You can Update tommorow's menu by submitting this form</h2>
<form action="<?php echo $_SERVER["PHP_SELF"];?> " method="post" >
<label >Breakfast:</label>
<textarea  name="Breakfast" value="<?php echo $inputs['Breakfast'] ?? ''; ?>" placeholder="<?php echo $data['Breakfast t'] ?? ''; ?>"></textarea><br><br>
<label >Lunch:</label>
<textarea name="Lunch" value="<?php echo $inputs['Lunch'] ?? ''; ?>" placeholder="<?php echo $data['Lunch t'] ?? ''; ?>"></textarea><br><br>
<label >Dinner:</label>
<textarea name="Dinner" value="<?php echo $inputs['Dinner'] ?? ''; ?>" placeholder="<?php echo $data['Dinner t'] ?? ''; ?>"></textarea><br><br>

</label>
<input type="submit"  name="submit" value="Submit" >
<br>
</form>
<a href="http://localhost/phpt/project%20hw1/menu_hostel.php"><button>Back to menu</button></a>
<h3>note:by submitting this form your current tommorow's menu will be set as today's menu.</h3>
