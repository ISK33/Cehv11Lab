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
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>CEHv11 Lab </title>

  

<style>

        body{ font: 14px sans-serif; text-align: center; }
		.card-body{ font: 14px sans-serif; text-align: center; }

</style>

	</head>
<body>

<?php if (isset($_COOKIE["user"])&&isset($_COOKIE["valid"])){
		if($_COOKIE["user"]==base64_decode('YWRtaW4=') && $_COOKIE["valid"]==base64_decode('VHJ1ZQ==')){
	?>
    <h1 class="my-5">Hi Admin</h1>
<h2 class="my-5">Users List</h2>
		
    </p>		
	
	  <div>

	<?php
		  $query1 = "SELECT * FROM users ORDER BY id DESC LIMIT 7";
          $query_run = mysqli_query($link, $query1);
          
            if (mysqli_num_rows($query_run) > 0) {
              while ($row1 = mysqli_fetch_assoc($query_run)) {
            ?>
		<div class="card" style="width: 18rem; margin-left: auto;
  margin-right: auto;">
  <div class="card-body">

<form action="articles/fordisc.php" method="post">
						                        
<img src="person.png"/>
    <h5 class="card-title"><?php echo $row1['username']; ?></h5>
    <a name="morebtn" id="<?php echo $row1['id']; ?>" onclick="getId(this.id)"  class="btn btn-primary">details</a>
  </div>
</div>
                      
                      </form>
					  <br>
					 </div>     
  					 
			<?php
			}
			}
		} else echo "<br><br><br><h1>You aren't admin</h1> <a href='mems1.jpg' title='Image from freeiconspng.com'>
	<img src='mems1.jpg' width='300' alt='ban, stop icon' /></a>";
		
	} else echo "<br><br><br><h1>You aren't admin</h1> <a href='mems1.jpg' title='Image from freeiconspng.com'>
	<img src='mems1.jpg' width='300' alt='ban, stop icon' /></a>";
	
	?>
		   
	 
	

	<script type="text/javascript">
            document.getElementById("more").addEventListener("click", myFunction);

            function getId(clicked_id) {
              window.location.href = "user.php?id=" + clicked_id;

            }
          </script>
</body>
</html>
