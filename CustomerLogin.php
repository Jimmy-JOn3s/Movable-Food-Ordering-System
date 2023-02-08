<?php  
session_start();
include('connection.php');
include('Header1.php');
if(isset($_POST['btnLogin'])) 
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];


	$check="SELECT * FROM Customer 
			WHERE Email='$txtEmail'
			AND Password='$txtPassword'";
	$ret=mysqli_query($connection,$check);
	$count=mysqli_num_rows($ret);
	$row=mysqli_fetch_array($ret);

	if($count < 1) 
	{
		echo "<script>window.alert('UserName or Password Incorrect!')</script>";
		echo "<script>window.location='CustomerLogin.php'</script>";
	}
	else
	{
		$_SESSION['CustomerID']=$row['CustomerID'];
		$_SESSION['Name']=$row['Name'];
		$_SESSION['Phone']=$row['Phone'];
		$_SESSION['Address']=$row['Address'];

		
		echo "<script>window.alert('Login Success!')</script>";
		echo "<script>window.location='MenuDisplay.php'</script>";	
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Login</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="owncss.css">
<form action="CustomerLogin.php" method="post">
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

</form>
</body>
</html>
<?php include('Footer1.php'); ?>