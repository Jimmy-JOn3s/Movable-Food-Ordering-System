<?php  
session_start();
include('connection.php');
include('Header2.php');
if(isset($_GET['SupplierID'])) 
{
	$SupplierID=$_GET['SupplierID'];
	$query="SELECT * FROM Supplier WHERE SupplierID='$SupplierID' ";
	$ret=mysqli_query($connection,$query);
	$row=mysqli_fetch_array($ret);
}

if(isset($_POST['btnUpdate'])) 
{
	$txtSupplierID=$_POST['txtSupplierID'];
	$txtSupplierName=$_POST['txtSupplierName'];
	$txtEmail=$_POST['txtEmail'];
	$txtPhone=$_POST['txtPhone'];
	$txtPassword=$_POST['txtPassword'];
	$txtAddress=$_POST['txtAddress'];

	$Update="UPDATE Supplier
			 SET 
			 SupplierName='$txtSupplierName',
			 Email='$txtEmail',
			 Password='$txtPassword',
			 Phone='$txtPhone',
			 Address='$txtAddress'
			 WHERE SupplierID='$txtSupplierID'
			";
	$ret=mysqli_query($connection,$Update);

	if($ret) 
	{
		echo "<script>window.alert('Staff Account Updated!')</script>";
		echo "<script>window.location='StaffEntry.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Staff Update " . mysqli_errno($connection) . "</p>";
	}

}

?>
<!DOCTYPE html>
<html>
<head>
<title>Staff Update</title>
</head>
<body>
<form action="StaffUpdate.php" method="post">
<fieldset>
<legend>Enter Staff Update Infomation</legend>
<table>
<tr>
	<td>Staff Name :</td>
	<td>
		<input type="text" name="txtSupplierName" value="<?php echo $row['SupplierName'] ?>" required />
	</td>
</tr>
<tr>
	<td>Email :</td>
	<td>
		<input type="email" name="txtEmail" value="<?php echo $row['Email'] ?>" required />
	</td>
</tr>
<tr>
	<td>Password :</td>
	<td>
		<input type="password" name="txtPassword" value="<?php echo $row['Password'] ?>" required />
	</td>
</tr>
<tr>
	<td>Phone :</td>
	<td>
		<input type="text" name="txtPhone" value="<?php echo $row['Phone'] ?>" required />
	</td>
</tr>
<tr>
	<td>Address :</td>
	<td>
		<textarea name="txtAddress"><?php echo $row['Address'] ?></textarea>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="hidden" name="txtSupplierID" value="<?php echo $row['SupplierID'] ?>"  />
		<input type="submit" name="btnUpdate" value="Update" />
		<input type="reset" value="Cancel" />
	</td>
</tr>
</table>

</fieldset>
</form>
</body>
</html>
<?php include('Footer1.php') ?>
