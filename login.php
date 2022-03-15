<?php
// Initialize the session
require_once('recaptchalib.php');
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	           header("location: index.php");

    exit;
}

// Include config file
require_once "conn.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;   
				
	
                            header("location: index.php");

	
                            // Redirect user to welcome page
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 



<title>Login to CEH LAB</title>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 <!--reCaptcha script-->
        <script type="text/javascript">
          var verifyCallback = function(response) {
            alert(response);
          };
          var widgetId1;
          var widgetId2;
          var onloadCallback = function() {
            // Renders the HTML element with id 'example1' as a reCAPTCHA widget.
            // The id of the reCAPTCHA widget is assigned to 'widgetId1'.
            widgetId1 = grecaptcha.render('example1', {
              'sitekey' : 'your_site_key',
              'theme' : 'light'
            });
            widgetId2 = grecaptcha.render(document.getElementById('example2'), {
              'sitekey' : '6LdxaLwaAAAAANb93yCoRBipwlUa4EJ809F3eP0C'
            });
            grecaptcha.render('example3', {
              'sitekey' : '6LdxaLwaAAAAANb93yCoRBipwlUa4EJ809F3eP0C',
              'callback' : verifyCallback,
              'theme' : 'dark'
            });
          };
        </script>
		    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <h4 class="mt-1 mb-5 pb-1">We are The CُEH Team</h4>
                </div>

                <form method="POST" action="login.php">
                  <p>Please login to your account</p>

                  <div class="form-outline mb-4">
                    <input type="name"  class="form-control" name="username" placeholder="username"/>
                    <label class="form-label" for="form2Example11">Username</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" class="form-control"name="password" />
                    <label class="form-label" for="form2Example22">Password</label>
                  </div>
            <div class="g-recaptcha" data-sitekey="6LdxaLwaAAAAANb93yCoRBipwlUa4EJ809F3eP0C"></div>
            <div id="recaptcha-feedback" class="mt-0 mb-3 invalid-feedback d-block">
</div>
<?php
		if (isset($_SESSION['message'])){
			echo $_SESSION['message'];
		}
		unset($_SESSION['message']);
	?>
</span>
         	<div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger" onclick="location.href='register.php'">Create new</button>
                  </div>
                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"  type="submit" value="Login" name="login">Log in</button>
                  </div>
	<span>
       </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a Hacker</h4>
                <p class="small mb-0"> we are leading Cybersecurity training endeavoring to produce proficient security professionals with 360 degree understanding of the information security architecture, ethical hacking, and security governance. </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
