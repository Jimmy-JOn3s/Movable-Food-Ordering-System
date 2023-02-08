<?php  
session_start();
include('connection.php');
include('Header1.php');
if(isset($_GET['CustomerID'])) 
{
	$CustomerID=$_GET['CustomerID'];
	$query="SELECT * FROM Customer WHERE CustomerID='$CustomerID' ";
	$ret=mysqli_query($connection,$query);
	$row=mysqli_fetch_array($ret);
}

if(isset($_POST['btnUpdate'])) 
{
	$txtCustomerID=$_POST['txtCustomerID'];
	$txtCName=$_POST['txtCName'];
	$txtEmail=$_POST['txtEmail'];
	$txtPhone=$_POST['txtPhone'];
	$txtPassword=$_POST['txtPassword'];
	$txtAddress=$_POST['txtAddress'];

	$Update="UPDATE Customer
			 SET 
			 Name='$txtCName',
			 Email='$txtEmail',
			 Password='$txtPassword',
			 Phone='$txtPhone',
			 Address='$txtAddress'
			 WHERE CustomerID='$txtCustomerID'
			";
	$ret=mysqli_query($connection,$Update);

	if($ret) 
	{
		echo "<script>window.alert('Customer Account Updated!')</script>";
		echo "<script>window.location='CustomerEntry.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Customer Update " . mysqli_errno($connection) . "</p>";
	}

}

?>
<!DOCTYPE html>
<html>
<head>
<title>Customer Update</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="owncss.css">
<form action="CustomerUpdate.php" method="POST">
  <div class="container">
    <h1>Upate</h1>
    <hr>

    <label for="info"><b>CustomerName</b></label>
    <input type="text" placeholder="Enter Name" name="txtCName" id="" value="<?php echo $row['Name'] ?>" required>

     <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="txtEmail" id="email" value="<?php echo $row['Email'] ?>"  required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="txtPassword" id="psw" value="<?php echo $row['Password'] ?>" required>

     <label for="info"><b>Phone</b></label>
    <input type="text" placeholder="Enter Phone" name="txtPhone" id="" value="<?php echo $row['Phone'] ?>" required>

     <label for="info"><b>Address</b></label>
    <input type="text" placeholder="Enter Address" name="txtAddress" id="" value="<?php echo $row['Address'] ?>" required>

    <hr>

    <input type="hidden" name="txtCustomerID" value="<?php echo $row['CustomerID'] ?>"  />
		<input type="submit" class="registerbtn" name="btnUpdate" value="Update" />
		<input type="reset"  class="registerbtn" value="Cancel" /> 
  </div>

  
</body>
</html>
<?php include('Footer1.php') ?>
