<?php
include('conn.php');
$search = $_POST['search'];
$sql = "select * from accounts where username = '$search'";

$result = mysqli_query($conn,$sql);

if ($result->num_rows > 0){
while($row = $result->fetch_assoc() ){
	echo $row["userid"]."  ".$row["username"]."  ".$row["fullname"]."<br>";
}
} else {
	echo "0 records";
}
	
?>
