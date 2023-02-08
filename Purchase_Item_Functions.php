<?php  
function AddItem($ItemID,$PurchasePrice,$PurchaseQuantity)
{
	include('connection.php');

	$query="SELECT * FROM Item WHERE ItemID='$ItemID' ";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);
	$rows=mysqli_fetch_array($ret);
	echo $query;
	if($count < 1) 
	{
		echo "<p>No Item Information Found.</p>";
		exit();
	}

	if($PurchaseQuantity < 1) 
	{
		echo "<p>Please enter correct quantity.</p>";
		exit();
	}

	if(isset($_SESSION['Purchase_Functions'])) //Session Array check
	{
		
		$index=IndexOf($ItemID);

		if ($index == -1) 
		{
			//Condition 2
			$size=count($_SESSION['Purchase_Functions']);

			$_SESSION['Purchase_Functions'][$size]['ItemID']=$ItemID;
			$_SESSION['Purchase_Functions'][$size]['PurchasePrice']=$PurchasePrice;
			$_SESSION['Purchase_Functions'][$size]['PurchaseQuantity']=$PurchaseQuantity;
			$_SESSION['Purchase_Functions'][$size]['ItemName']=$rows['ItemName'];
		}
		else
		{
			//Condition 3
			$_SESSION['Purchase_Functions'][$index]['PurchaseQuantity']+=$PurchaseQuantity;
		}
	}
	else
	{
		//Condition 1
		$_SESSION['Purchase_Functions']=array(); // Create Session Array

		$_SESSION['Purchase_Functions'][0]['ItemID']=$ItemID;
		$_SESSION['Purchase_Functions'][0]['PurchasePrice']=$PurchasePrice;
		$_SESSION['Purchase_Functions'][0]['PurchaseQuantity']=$PurchaseQuantity;
		$_SESSION['Purchase_Functions'][0]['ItemName']=$rows['ItemName'];
	}
	echo "<script>window.location='ItemOrder.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	$size=count($_SESSION['Purchase_Functions']);

	for ($i=0; $i < $size; $i++) 
	{ 
		$Price=$_SESSION['Purchase_Functions'][$i]['PurchasePrice'];
		$Quantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];

		$TotalAmount+=($Price * $Quantity);
	}
	return $TotalAmount;
}

function CalculateTotalQuantity()
{
	$TotalQuantity=0;

	$size=count($_SESSION['Purchase_Functions']);

	for ($i=0; $i < $size; $i++) 
	{ 
		$Quantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];

		$TotalQuantity+=$Quantity;
	}
	return $TotalQuantity;
}

function RemoveItem($ItemID)
{
	$index=IndexOf($ItemID);

	unset($_SESSION['Purchase_Functions'][$index]);

	$_SESSION['Purchase_Functions']=array_values($_SESSION['Purchase_Functions']);
	echo "<script>window.location='ItemOrder.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['Purchase_Functions']);
	echo "<script>window.location='ItemOrder.php'</script>";
}

function IndexOf($ItemID)
{
	if(!isset($_SESSION['Purchase_Functions'])) 
	{
		return -1;
	}

	$count=count($_SESSION['Purchase_Functions']);

	if($count < 1) 
	{
		return -1;
	}

	for ($i=0; $i < $count; $i++) 
	{ 
		if ($ItemID == $_SESSION['Purchase_Functions'][$i]['ItemID'] ) 
		{
			return $i;
		}
	}
	return -1;
}

?>