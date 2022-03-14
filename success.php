<?php
	session_start();
	
	if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
		header('index.php');
		exit();
	}
	include('conn.php');
	$query=mysqli_query($link,"select * from users where id='".$_SESSION['id']."'");
	$row=mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
<body>
<?php if (isset($_COOKIE["user"])&&isset($_COOKIE["valid"])){
		if($_COOKIE["user"]==base64_decode('YWRtaW4=') && $_COOKIE["valid"]==base64_decode('VHJ1ZQ==')){
	?>
    <h1 class="my-5">Hi Admin</h1>
	
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
		
    </p>


<form action="" method="get">
Search <input type="text" size="100" name="search"><br>
<input type ="submit">
</form>
</body>

</html>
<?php
if (isset($_GET['search'])){
$search = $_GET['search'];
$sql = "select * from users where username = '$search'";

$result = mysqli_query($link,$sql);

if ($result->num_rows > 0){
        	echo "[id]   [username]  "."<br>";

while($row = $result->fetch_assoc() ){
	echo "    [".$row["id"]."]      [".$row["username"]."]      <br>";
}
} else {
	echo "0 records";
}}
	}
		    ?>
	 
	<?php }else echo "<br><br><br><h1>You aren't admin</h1> <a href='https://www.freeiconspng.com/img/13412' title='Image from freeiconspng.com'><img src='https://www.freeiconspng.com/uploads/ban-stop-icon-22.png' width='300' alt='ban, stop icon' /></a>"?>

</body>
</html>