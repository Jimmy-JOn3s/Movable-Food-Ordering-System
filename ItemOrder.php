<?php  
session_start();

include('connection.php');
include('AutoIDFunction.php');
include('Purchase_Item_Functions.php');



if(isset($_POST['btnAdd'])) 
{
	$ItemID=$_POST['cboItemID'];
	$PurchasePrice=$_POST['txtPurchasePrice'];
	$PurchaseQuantity=$_POST['txtPurchaseQuantity'];

	AddItem($ItemID,$PurchasePrice,$PurchaseQuantity);
}

if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if ($action === 'remove') 
	{
		$ItemID=$_GET['ItemID'];
		RemoveItem($ItemID);
	}
	elseif ($action === 'clearall') 
	{
		ClearAll();
	}
}

if(isset($_POST['btnSave'])) 
{
	$txtPIID=$_POST['txtPIID'];
	$txtPIDate=$_POST['txtPIDate'];
	$txtTotalAmount=$_POST['txtTotalAmount'];
	$txtTotalQuantity=$_POST['txtTotalQuantity'];
	$txtVAT=$_POST['txtVAT'];
	$txtGrandTotal=$_POST['txtGrandTotal'];
	$cboSupplier=$_POST['cboSupplier'];

	$StaffID=$_SESSION['StaffID'];
	$Status='Pending';

	//Insert data to Purchase Table (1)
	$InsertOrder="INSERT INTO `purchaseitem`
				  (`PurchaseID`, `PurchaseItemDate`, `TotalAmount`, `TotalQuantity`, `TaxAmount`, `GrandTotal`, `SupplierID`, `StaffID`, `Status`) 
				  VALUES
				  ('$txtPIID','$txtPIDate','$txtTotalAmount','$txtTotalQuantity','$txtVAT','$txtGrandTotal','$cboSupplier','$StaffID','$Status')
				   ";
	$ret=mysqli_query($connection,$InsertOrder);
	//--------------------------------------------------------------------------------

	//Insert data to PurchaseDetails Table (*)----------------------------------------

	$count=count($_SESSION['Purchase_Functions']);

	for ($i=0;$i<$count;$i++) 
	{ 
		$ItemID=$_SESSION['Purchase_Functions'][$i]['ItemID'];
		$PurchasePrice=$_SESSION['Purchase_Functions'][$i]['PurchasePrice'];
		$PurchaseQuantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];

		$InsertOrderDetails="INSERT INTO `purchaseitemdetail`
					(`PurchaseID`, `ItemID`, `PurchaseQuantity`, `PurchasePrice`) 
					VALUES
					('$txtPIID','$ItemID','$PurchaseQuantity','$PurchasePrice')
					";
		$ret=mysqli_query($connection,$InsertOrderDetails);
	}
	//-------------------------------------------------------------------------------

	if($ret) 
	{
		echo "<script>window.alert('Item Order Successfully Saved!')</script>";
		unset($_SESSION['Purchase_Functions']);
		echo "<script>window.location='StaffHome.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Puchase Item Order " . mysqli_error($connection) . "</p>";
	}
}
include('Header2.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Item Order</title>


</head>
<body>
<form action="ItemOrder.php" method="post" enctype="multipart/form-data">
<fieldset align="center">
<legend>Purchase Item Form</legend>
<table align="center" 	cellpadding="5px">
<tr>
	<td>PI Date</td>
	<td>
		: <input type="text" name="txtPIDate" value="<?php echo date('Y-m-d') ?>" readonly />
	</td>
	<td>TotalAmount</td>
	<td>
		: <input type="number" name="txtTotalAmount" value="<?php echo CalculateTotalAmount() ?>" readonly /> USD
	</td>
</tr>
<tr>
	<td>PI ID</td>
	<td>
		: <input type="text" name="txtPIID" value="<?php echo AutoID('purchaseitem','PurchaseID','PUR-',6) ?>" readonly />
	</td>
	<td>TotalQuantity</td>
	<td>
		: <input type="number" name="txtTotalQuantity" value="<?php echo CalculateTotalQuantity() ?>" readonly /> pcs
	</td>
</tr>
<tr>
	<td>StaffInfo</td>
	<td>
		: <input type="text" name="txtStaffInfo" value="<?php echo $_SESSION['StaffName'] ?>" readonly />
	</td>
	<td>VAT (5%)</td>
	<td>
		: <input type="number" name="txtVAT" value="<?php echo CalculateTotalAmount() * 0.05 ?>" readonly /> USD
	</td>
</tr>
<tr>
	<td>ItemInfo</td>
	<td>
		: 
		<select name="cboItemID">
			<option>----Choose Item----</option>
			<?php  
			$P_query="SELECT * FROM Item";
			$P_ret=mysqli_query($connection,$P_query);
			$P_count=mysqli_num_rows($P_ret);

			for($i=0; $i < $P_count; $i++) 
			{ 
				$P_arr=mysqli_fetch_array($P_ret);

				$ItemID=$P_arr['ItemID'];
				$ItemName=$P_arr['ItemName'];

				echo "<option value='$ItemID'>$ItemID  -  $ItemName</option>";
			}
			?>
		</select>
	</td>
	<td>GrandTotal</td>
	<td>
		: <input type="number" name="txtGrandTotal" value="<?php echo CalculateTotalAmount() * 0.05 + CalculateTotalAmount()  ?>" readonly /> USD
	</td>
</tr>
<tr>
	<td>Purchase Price</td>
	<td>
		: <input type="number" name="txtPurchasePrice" value="0" required="" /> USD
	</td>
</tr>
<tr>
	<td>Purchase Quantity</td>
	<td>
		: <input type="number" name="txtPurchaseQuantity" value="0" required="" /> pcs
	</td>
</tr>
<tr>
	<td></td>
	<td>
		: <input type="submit" name="btnAdd" value="Add"  />
		  <input type="reset"  value="Cancel"  />
	</td>
</tr>
</table>

<hr>

<?php  
if(!isset($_SESSION['Purchase_Functions'])) 
{
	echo "<p>No Purchase Record.</p>";
	//exit();
}
else
{
?>
	<table align="center" border="1" cellpadding="3px">
	<tr>
		<th>ItemID</th>
		<th>ItemName</th>
		<th>PurchasePrice</th>
		<th>PurchaseQuantity</th>
		<th>Sub-Total</th>
		<th>Action</th>
	</tr>
	<?php  
	$count=count($_SESSION['Purchase_Functions']);

	for($i=0;$i<$count;$i++) 
	{ 
		$ItemID=$_SESSION['Purchase_Functions'][$i]['ItemID'];
		echo "<tr>";
			echo "<td>" . $_SESSION['Purchase_Functions'][$i]['ItemID'] . "</td>";
			echo "<td>" . $_SESSION['Purchase_Functions'][$i]['ItemName'] . "</td>";
			echo "<td>" . $_SESSION['Purchase_Functions'][$i]['PurchasePrice'] . "</td>";
			echo "<td>" . $_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'] . "</td>";
			echo "<td>" . $_SESSION['Purchase_Functions'][$i]['PurchasePrice'] * 
						  $_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'] . 
				 "</td>";
			echo "<td> <a href='ItemOrder.php?ItemID=$ItemID&action=remove'>Remove</a> </td>";
		echo "</tr>";
	}
	?>
	<tr>
		<td colspan="6" align="right">
		Choose Info :
		<select name="cboSupplier">
			<option>--Choose-Supplier--</option>
			<?php  
			$S_query="SELECT * FROM supplier";
			$S_ret=mysqli_query($connection,$S_query);
			$S_count=mysqli_num_rows($S_ret);

			for($i=0; $i < $S_count; $i++) 
			{ 
				$S_arr=mysqli_fetch_array($S_ret);

				$SupplierID=$S_arr['SupplierID'];
				$SupplierName=$S_arr['SupplierName'];

				echo "<option value='$SupplierID'>$SupplierID  -  $SupplierName</option>";
			}
			?>
		</select>
		| 
		<input type="submit" name="btnSave" value="Confirmed Purchase" />
		| 
		<a href="ItemOrder.php?action=clearall">Clear All</a>
		</td>
	</tr>
	</table>
<?php
}
?>

</fieldset>
</form>
</body>
</html>
<?php 
include('Footer1.php');
 ?>