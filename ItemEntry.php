<?php  
session_start();
include('connection.php');
include('Header2.php');

if(isset($_POST['btnSave'])) 
{
	$ItemName=$_POST['txtItemName'];
	$Quantity=$_POST['txtQuantity'];
	$Price=$_POST['txtPrice'];
	//----------------------------------------------------------

	$InsertItem="INSERT INTO Item (ItemName,Quantity,Price)
				  VALUES
				  ('$ItemName','$Quantity','$Price')";
	$ret=mysqli_query($connection,$InsertItem);
	echo $InsertItem;

	if($ret) 
	{
		echo "<script>window.alert('New Item Successfully Registered!')</script>";
		echo "<script>window.location='ItemEntry.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Item Entry " . mysqli_errno($connection) . "</p>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Item Entry</title>

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
<link rel="stylesheet" type="text/css" href="owncss.css">
<form action="ItemEntry.php" method="POST" enctype="multipart/form-data">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to register Item.</p>
    <hr>

    <label for="info"><b>ItemName</b></label>
    <input type="text" placeholder="Enter Item" name="txtItemName" id="" required>

     <label for="info"><b>Quantity</b></label>
    <input type="text" placeholder="Enter Quantity" name="txtQuantity" id="" required>

    <label for=""><b>Price</b></label>
    <input type="text" placeholder="Enter Price" name="txtQuantity" id="" required>
    <hr>

    
    <input type="submit" class="registerbtn" name="btnSave" value="Save" />
    <input type="reset" class="registerbtn" value="Cancel" />
  </div>
  </div>
  <table id="tableid" class="display">

</body>
</html>
<?php include('Footer1.php') ?>
