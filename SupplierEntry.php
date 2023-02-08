<?php  
session_start();
include('connection.php');
include('Header2.php');

if(isset($_POST['btnSave'])) 
{
	$txtSupplierName=$_POST['txtSupplierName'];
	$txtEmail=$_POST['txtEmail'];
	$txtPhone=$_POST['txtPhone'];
	$txtPassword=$_POST['txtPassword'];
	$txtAddress=$_POST['txtAddress'];

	//Check Email already exist coding
	$checkEmail="SELECT * FROM Supplier
				WHERE Email='$txtEmail'";
	$ret=mysqli_query($connection,$checkEmail);
	$count=mysqli_num_rows($ret);

	if($count > 0) 
	{
		echo "<script>window.alert('Email address $txtEmail already exist!')</script>";
		echo "<script>window.location='CustomerEntry.php'</script>";
	}
	else
	{
		$InsertCustomer="INSERT INTO Supplier
					  (SupplierName,Email,Password,Phone,Address)
					  VALUES 
					  ('$txtSupplierName','$txtEmail','$txtPassword','$txtPhone','$txtAddress')";
		$ret=mysqli_query($connection,$InsertCustomer);

		if($ret) 
		{
			echo "<script>window.alert('Supplier Account Created!')</script>";
			echo "<script>window.location='SupplierEntry.php'</script>";
		}
		else
		{
			echo "<p>Something went wrong in Supplier Entry " . mysqli_errno($connection) . "</p>";
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Supplier Entry</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>

<script>
	$(document).ready
	( function ()
	{
		$('#tableid').DataTable();
	}
	);
</script>

<form action="SupplierEntry.php" method="post">
<fieldset>
<legend>Enter Supplier Infomation</legend>
<table>
<tr>
	<td>Supplier Name :</td>
	<td>
		<input type="text" name="txtSupplierName" placeholder="Alan Smith" required />
	</td>
</tr>
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
	<td>Phone :</td>
	<td>
		<input type="text" name="txtPhone" placeholder="+95-----------" required />
	</td>
</tr>
<tr>
	<td>Address :</td>
	<td>
		<textarea name="txtAddress"></textarea>
	</td>
</tr>
<tr>
	<td><a href="#">Login?</a></td>
	<td>
		<input type="submit" name="btnSave" value="Save" />
		<input type="reset" value="Cancel" />
	</td>
</tr>
</table>

<hr/>

<table id="tableid" class="display">
<thead>
	<tr>
		<th>#</th>
		<th>SupplierID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Address</th>
		<th>Action</th>
	</tr>	
</thead>	
<tbody>
<?php  
$query="SELECT * FROM Supplier";
$ret=mysqli_query($connection,$query);
$count=mysqli_num_rows($ret);

for ($i=0;$i<$count;$i++) 
{ 
	$arr=mysqli_fetch_array($ret);

	$SupplierID=$arr['SupplierID'];
	$SupplierName=$arr['SupplierName'];

	echo "<tr>";
		echo "<td>" . ($i + 1) . "</td>";
		echo "<td>" . $SupplierID . "</td>";
		echo "<td>" . $SupplierName . "</td>";
		echo "<td>" . $arr['Email'] . "</td>";
		echo "<td>" . $arr['Phone'] . "</td>";
		echo "<td>" . $arr['Address'] . "</td>";
		
		echo "<td>
			 	<a href='SupplierUpdate.php?SupplierID=$SupplierID'>Edit</a>
			 	<a href='SupplierDelete.php?SupplierID=$SupplierID'>Delete</a>
			  </td>";
	echo "</tr>";	
}
?>
</tbody>
</table>
</fieldset>
</form>
</body>
</html>
<?php include('Footer1.php') ?>
