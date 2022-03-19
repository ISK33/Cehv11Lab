
<div class="card" style="width: 100%; margin-left: auto;
  margin-right: auto;">
<?php session_start();
	
	if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
		header('index.php');
		exit();
	}
	

	include('conn.php');
	$query=mysqli_query($link,"select * from users where id='".$_GET['id']."'");

if ($query->num_rows > 0){
	
$str1= (explode("'",$_GET['id']));

		if ((trim ($_SESSION['id']) == $str1[0])) {
              while ($row = mysqli_fetch_assoc($query)) {
					echo " <h1>   id= ".$row["id"]."   <br> username= ".$row["username"]."<br> password= ".$row["password"]."  </h1>   <br>";

}
}else{$row = mysqli_fetch_assoc($query); echo "<h1 >you are not ".$row["username"]."</h1>";}
		}
?>
</div>