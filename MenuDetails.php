<?php  
session_start();
include('connection.php');
include('Shopping_Cart_Functions.php');
include('Header1.php');

if(isset($_POST['btnAddtoCart'])) 
{
	echo "abc";
	$txtMenuID=$_POST['txtMenuID'];
	$txtBuyQuantity=$_POST['txtBuyQuantity'];

	AddMenu($txtMenuID,$txtBuyQuantity);
	//echo "<script>window.location='Shopping_Cart.php'</script>";
}

$MenuID=$_GET['MenuID'];

$query="SELECT * from Menu where MenuID='$MenuID'";
$ret=mysqli_query($connection,$query);
$row=mysqli_fetch_array($ret);

$MenuID=$row['MenuID'];
$Menu=$row['Menu'];	
$MenuPhoto=$row['MenuPhoto'];
$Price=$row['Price'];	


list($width,$height)=getimagesize($MenuPhoto);
$w=$width/1.5;
$h=$height/1.5;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Menu Details</title>
</head>
<body>
<form action="MenuDetails.php" method="post">
<fieldset>
<legend align="center">Menu Details :</legend>

<table align="center">
<tr>
	<td>
		<img id="MImage" src="<?php echo $MenuPhoto ?>" width="<?php echo $w ?>" height="<?php echo $h ?>" />
		<hr/>
	</td>
	<td>
		<fieldset>
		<table cellpadding="5px">
			<tr>
				<td>Menu</td>
				<td>: <b><?php echo $Menu ?></b></td>
			</tr>
			<tr>
				<td>Price</td>
				<td>: <b><?php echo $Price ?></b> USD</td>
			</tr>
			<tr>
				<td>Buying Quantity</td>
				<td>: 
					<input type="text" name="txtBuyQuantity" value="1" size="3"  />
					<input type="hidden" name="txtMenuID" value="<?php echo $MenuID ?>" />
					<input type="submit" name="btnAddtoCart" value="Add to Cart" />
				</td>
			</tr>
		</table>
		</fieldset>
	</td>
</tr>
<!--<tr>
	<td colspan="2">
	<b>Description</b>
	<hr>
	<?php echo $Description ?>
	</td>
</tr>-->
</table>
</fieldset>
</form>
</body>
</html>
<?php include('Footer1.php'); ?>