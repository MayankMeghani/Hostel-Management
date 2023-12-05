<?php
error_reporting(0);
session_start();
require_once "connection.php";
$hostel=$_SESSION["Hostel"];
$ann=[];    
$count=0;
$querry2="SELECT * FROM `announcements` WHERE `Hostel Name` LIKE '$hostel'";
$result2=mysqli_query($link,$querry2);
while($data2=mysqli_fetch_assoc($result2)){
    $ann[$count++]=$data2['Announcements'];    
} 
?>

<form action="<?php echo $_SERVER["PHP_SELF"];?> " method="post" >
<?php
for($i=0;$i<$count;$i++){
    echo $ann[$i];
    echo "<input type=checkbox name=$i > <br>";
}

?>
<br>
<input type="submit"  name="submit" value="Delete" onclick="Fun()">
</form>

<a href="http://localhost/phpt/project%20hw1/announcement.php"><button>Back to announcement</button></a>
<h2>Click two time on delete button to confirm and view result</h2>
<?php
$c=0;

if(isset($_POST['submit'])){
    for($i=0;$i<$count;$i++){
        if($_POST[$i]=="on"){
            $result2=mysqli_query($link,$querry2);
            while($data2=mysqli_fetch_assoc($result2)){
                if($i==$c++){
                    $querry3="DELETE FROM `announcements` WHERE `Announcements`='$data2[Announcements]'";
                    $result3=mysqli_query($link,$querry3);
                }
            }
        
    }
    }
}
?>
<script>
    function Fun(){
        document.location='http://localhost/phpt/project%20hw1/announcement.php';
    }
</script>