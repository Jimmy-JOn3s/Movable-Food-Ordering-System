<?php  
session_start();
include('connection.php');
include('Header2.php');
if(isset($_POST['btnLogin'])) 
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];


	$check="SELECT * FROM Staff 
			WHERE Email='$txtEmail'
			AND Password='$txtPassword'";
	$ret=mysqli_query($connection,$check);
	$count=mysqli_num_rows($ret);
	$row=mysqli_fetch_array($ret);

	if($count < 1) 
	{
		echo "<script>window.alert('UserName or Password Incorrect!')</script>";
		echo "<script>window.location='Staff_Login.php'</script>";
	}
	else
	{
		$_SESSION['StaffID']=$row['StaffID'];
		$_SESSION['StaffName']=$row['StaffName'];
		$_SESSION['Role']=$row['Role'];

		echo "<script>window.alert('Login Success!')</script>";
		echo "<script>window.location='StaffHome.php'</script>";	
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Login</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="owncss.css">
<form action="StaffLogin.php" method="post">
<div class="container">
    <h1>Log In</h1>
    <p>Please fill in this form to Log In an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="txtEmail" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="txtPassword" id="psw" required>

    <input type="submit" class="registerbtn" name="btnLogin" value="Login" />
    <input type="reset" class="registerbtn" value="Cancel" />
  </div>
  <div class="container signin">
    <p>Doesn't have an account? <a href="StaffEntry.php">Sign Up</a>.</p>
  </div>
  <table id="tableid" class="display">
</body>
</html>
<?php Include('Footer1.php'); ?>