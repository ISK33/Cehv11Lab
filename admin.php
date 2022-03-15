<?php echo " <?php if (isset($_COOKIE["user"])&&isset($_COOKIE["valid"])){
	if($_COOKIE["user"]==base64_decode("YWRtaW4=") && $_COOKIE["valid"]==base64_decode("VHJ1ZQ==")){
	?>
    <h1 class="my-5">Hi Admin</h1>
	
        <a href="logout.php" >Sign Out of Your Account</a>
		
    </p>


<form action="" method="get">
Search <input type="text" size="100" name="search"><br>
<input type ="submit">
</form>
</body>
}else echo "<br><br><br><h1>You aren't admin</h1> <a href='https://www.freeiconspng.com/img/13412' title='Image from freeiconspng.com'>
</html>"