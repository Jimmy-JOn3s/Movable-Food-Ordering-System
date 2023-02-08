<?php  
function AddMenu($MenuID,$BuyQuantity)
{
	include('connection.php');

	$query="SELECT * FROM Menu WHERE MenuID='$MenuID' ";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);
	$rows=mysqli_fetch_array($ret);

	if($count < 1) 
	{
		echo "<p>No Menu Information Found.</p>";
		exit();
	}

	if($BuyQuantity < 1) 
	{
		echo "<p>Please enter correct quantity.</p>";
		exit();
	}

	if(isset($_SESSION['ShoppingCart_Functions'])) //Session Array check
	{
		
		$index=IndexOf($MenuID);

		if ($index == -1) 
		{
			//Condition 2
			$size=count($_SESSION['ShoppingCart_Functions']);

			$_SESSION['ShoppingCart_Functions'][$size]['MenuID']=$MenuID;
			$_SESSION['ShoppingCart_Functions'][$size]['BuyQuantity']=$BuyQuantity;
			$_SESSION['ShoppingCart_Functions'][$size]['MenuPhoto']=$rows['MenuPhoto'];
			$_SESSION['ShoppingCart_Functions'][$size]['Price']=$rows['Price'];
			$_SESSION['ShoppingCart_Functions'][$size]['Menu']=$rows['Menu'];
		}
		else
		{
			//Condition 3
			$_SESSION['ShoppingCart_Functions'][$index]['BuyQuantity']+=$BuyQuantity;
		}
	}
	else
	{
		//Condition 1
		$_SESSION['ShoppingCart_Functions']=array(); // Create Session Array

		$_SESSION['ShoppingCart_Functions'][0]['MenuID']=$MenuID;
		$_SESSION['ShoppingCart_Functions'][0]['BuyQuantity']=$BuyQuantity;
		$_SESSION['ShoppingCart_Functions'][0]['MenuPhoto']=$rows['MenuPhoto'];
		$_SESSION['ShoppingCart_Functions'][0]['Menu']=$rows['Menu'];
		$_SESSION['ShoppingCart_Functions'][0]['Price']=$rows['Price'];
	}
	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	$size=count($_SESSION['ShoppingCart_Functions']);

	for ($i=0; $i < $size; $i++) 
	{ 
		$Price=$_SESSION['ShoppingCart_Functions'][$i]['Price'];
		$Quantity=$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'];

		$TotalAmount+=($Price * $Quantity);
	}
	return $TotalAmount;
}

function CalculateTotalQuantity()
{
	$TotalQuantity=0;

	$size=count($_SESSION['ShoppingCart_Functions']);

	for ($i=0; $i < $size; $i++) 
	{ 
		$Quantity=$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'];

		$TotalQuantity+=$Quantity;
	}
	return $TotalQuantity;
}

function RemoveMenu($MenuID)
{
	$index=IndexOf($MenuID);

	unset($_SESSION['ShoppingCart_Functions'][$index]);

	$_SESSION['ShoppingCart_Functions']=array_values($_SESSION['ShoppingCart_Functions']);
	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['ShoppingCart_Functions']);
	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function IndexOf($MenuID)
{
	if(!isset($_SESSION['ShoppingCart_Functions'])) 
	{
		return -1;
	}

	$count=count($_SESSION['ShoppingCart_Functions']);

	if($count < 1) 
	{
		return -1;
	}

	for ($i=0; $i < $count; $i++) 
	{ 
		if ($MenuID == $_SESSION['ShoppingCart_Functions'][$i]['MenuID'] ) 
		{
			return $i;
		}
	}
	return -1;
}

?>