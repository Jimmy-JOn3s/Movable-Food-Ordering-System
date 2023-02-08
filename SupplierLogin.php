<?php  
session_start();
include('connection.php');
include('Header3.php');

if(isset($_POST['btnLogin'])) 
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];


	$check="SELECT * FROM Supplier
			WHERE Email='$txtEmail'
			AND Password='$txtPassword'";
	$ret=mysqli_query($connection,$check);
	$count=mysqli_num_rows($ret);
	$row=mysqli_fetch_array($ret);

	if($count < 1) 
	{
		echo "<script>window.alert('UserName or Password Incorrect!')</script>";
		echo "<script>window.location='SupplierLogin.php'</script>";
	}
	else
	{
		$_SESSION['SupplierID']=$row['SupplierID'];
		$_SESSION['SupplierName']=$row['SupplierName'];
		
		echo "<script>window.alert('Login Success!')</script>";
		echo "<script>window.location='SupplierHome.php'</script>";	
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Supplier Login</title>
</head>
<body>
<form action="SupplierLogin.php" method="post">
<fieldset>
<legend>Enter Supplier Login Infomation</legend>
<table>
<tr>
	<td>Email :</td>
	<td>
		<input type="email" name="txtEmail" placeholder="example@email.com" required />
	</td>
</tr>
<tr>
	<td>Password :</td>
	<td>
		<input type="password" name="txtPassword" placeholder="XXXXXXXXXXXXXX" required />
	</td>
</tr>
<tr>
	<td><a href="#">Register?</a></td>
	<td>
		<input type="submit" name="btnLogin" value="Login" />
		<input type="reset" value="Cancel" />
	</td>
</tr>
</table>
</fieldset>
</form>
</body>
</html>
<?php include('Footer1.php'); ?>