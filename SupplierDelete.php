<?php
include('connection.php');

$SupplierID=$_GET['SupplierID'];

$query="DELETE FROM Supplier WHERE SupplierID='$SupplierID' ";
$ret=mysqli_query($connection,$query);

if($ret) //true
{
	echo "<script>window.alert('Supplier Account Deleted!')</script>";
	echo "<script>window.location='SupplierEntry.php'</script>";
}
else
{
	echo "<p>Something went wrong in Suppiler Delete " . mysqli_errno($connection) . "</p>";
}

?>