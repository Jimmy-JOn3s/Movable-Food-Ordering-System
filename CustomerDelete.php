<?php
include('connection.php');

$CustomerID=$_GET['CustomerID'];

$query="DELETE FROM Customer WHERE CustomerID='$CustomerID' ";
$ret=mysqli_query($connection,$query);

if($ret) //true
{
	echo "<script>window.alert('Customer Account Deleted!')</script>";
	echo "<script>window.location='CustomerEntry.php'</script>";
}
else
{
	echo "<p>Something went wrong in Customer Delete " . mysqli_errno($connection) . "</p>";
}

?>