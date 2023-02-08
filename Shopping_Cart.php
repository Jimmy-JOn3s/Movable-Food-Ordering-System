<?php  
session_start();
include('connection.php');
include('Shopping_Cart_Functions.php');
include('Header1.php');
if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if ($action === 'remove') 
	{
		$MenuID=$_GET['MenuID'];
		RemoveMenu($MenuID);
	}
	else
	{
		ClearAll();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
</head>
<body>
<form action="#" method="post">

<?php  
if(!isset($_SESSION['ShoppingCart_Functions'])) 
{
	echo "<p>Empty Cart. | <a href='MenuDisplay.php'>Continue Shopping</a></p>"; 
	exit();
}
else
{
?>
	<table border="1" cellpadding="5px" align="center">
	<tr>
		<th>Image</th>
		<th>MenuID</th>
		<th>Menu</th>
		<th>Price</th>
		<th>BuyQuantity</th>
		<th>Sub-Total</th>
		<th>Action</th>
	</tr>
	<?php  
	$count=count($_SESSION['ShoppingCart_Functions']);

	for($i=0;$i<$count;$i++) 
	{ 
		$MenuID=$_SESSION['ShoppingCart_Functions'][$i]['MenuID'];
		$MenuPhoto=$_SESSION['ShoppingCart_Functions'][$i]['MenuPhoto'];
		echo "<tr>";
			echo "<td>
					<img src='$MenuPhoto' width='100px' height='120' />
				  </td>";
			echo "<td>" . $_SESSION['ShoppingCart_Functions'][$i]['MenuID'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCart_Functions'][$i]['Menu'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCart_Functions'][$i]['Price'] . " USD</td>";
			echo "<td>" . $_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'] . " pcs</td>";
			echo "<td>" . $_SESSION['ShoppingCart_Functions'][$i]['Price'] * 
						  $_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'] . 
				 " USD</td>";
			echo "<td> <a href='Shopping_Cart.php?ProductID=$MenuID&action=remove'>Remove</a> </td>";
		echo "</tr>";
	}
	?>
	<tr>
		<td colspan="7">
			Total Quantity : <b><?php echo CalculateTotalQuantity() ?> pcs</b>
			<br/>
			Total Amount : <b><?php echo CalculateTotalAmount() ?> USD</b>
			<br/>
			VAT (5%) : <b><?php echo CalculateTotalAmount() * 0.05 ?> USD</b>
			<br/>
			Grand Total : <b><?php echo CalculateTotalAmount() * 0.05 + CalculateTotalAmount() ?> USD</b>
		</td>
	</tr>
	<tr>
		<td colspan="7" align="right">
		<a href="MenuDisplay.php">Continue Shopping</a> 
		|
		<a href="CheckOut.php">Make Checkout</a>
		|
		<a href="Shopping_Cart.php?action=clearall">Clear All</a>
		</td>
	</tr>
	</table>
<?php
}
?>


</form>
</body>
</html>
<?php include('Footer1.php'); ?>