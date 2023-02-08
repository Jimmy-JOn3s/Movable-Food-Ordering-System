<?php  
session_start();
include('connection.php');
include('Header2.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Menu Display</title>

	<style type="text/css">
	.price
	{
		color: red;
		background: ;
		font-size: 20pt;
		padding: 3px;
		font-family: Century Gothic;
	}
	.price:hover
	{
		color: blue;
		background: #CCC;
		font-size: 20pt;
		padding: 3px;
		font-family: Century Gothic;
	}
	</style>
</head>
<body>
<form action="MenuDisplay.php" method="post">

<fieldset>
<legend align="center">Menu Display</legend>
<table width="100%">
<tr align="right">
	<td>
		<input type="text" name="txtData" placeholder="Enter Keywords" />
		<input type="submit" name="btnSearch" value="Search">
	</td>
</tr>
</table>	
<hr/>
<table width="100%">
<?php  
	
if(isset($_POST['btnSearch'])) 
{
	$txtData=$_POST['txtData'];

	$query1="SELECT * FROM Menu
			 WHERE Menu LIKE '%$txtData%'
			 OR Price='$txtData' 
			 ";
	$ret1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($ret1);

	for($i=0;$i<$count1;$i+=4) 
	{ 
		$query2="SELECT * FROM Menu 
				 WHERE Menu LIKE '%$txtData%'
			 	 OR Price='$txtData'
				 LIMIT $i,4";
		$ret2=mysqli_query($connection,$query2);
		$count2=mysqli_num_rows($ret2);

		echo "<tr>";
		for ($x=0;$x<$count2;$x++) 
		{ 
			$row=mysqli_fetch_array($ret1);

			$MenuID=$row['MenuID'];
			$Menu=$row['Menu'];
			$MenuPhoto=$row['MenuPhoto'];
			$Price=$row['Price'];	

			list($width,$height)=getimagesize($MenuPhoto);
			$w=$width/2;
			$h=$height/2;
		?>
			<td align="center">
				<img src="<?php echo $MenuPhoto ?>" width="<?php echo $w ?>" height="<?php echo $h ?>" />
				<hr/>
				<b><?php echo $Menu ?></b>
				<br/>
				<b class="price"><?php echo $Price ?> USD</b> 
				<hr/>
				<a href="MenuDetails.php?MenuID=<?php echo $MenuID ?>">Details</a>
			</td>
		<?php
		}
		echo "</tr>";
	}
}
else
{
	$query1="SELECT * FROM Menu";
	$ret1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($ret1);

	for($i=0;$i<$count1;$i+=4) 
	{ 
		$query2="SELECT * FROM Menu LIMIT $i,4";
		$ret2=mysqli_query($connection,$query2);
		$count2=mysqli_num_rows($ret2);

		echo "<tr>";
		for ($x=0;$x<$count2;$x++) 
		{ 
			$row=mysqli_fetch_array($ret1);

			$MenuID=$row['MenuID'];
			$Menu=$row['Menu'];
			$MenuPhoto=$row['MenuPhoto'];
			$Price=$row['Price'];

			list($width,$height)=getimagesize($MenuPhoto);
			$w=$width/2;
			$h=$height/2;
		?>
			<td align="center">
				<img src="<?php echo $MenuPhoto ?>" width="<?php echo $w ?>" height="<?php echo $h ?>" />
				<hr/>
				<b><?php echo $Menu ?></b>
				<br/>
				<b class="price"><?php echo $Price ?> USD</b> 
				<hr/>
				<a href="MenuDetails.php?MenuID=<?php echo $MenuID ?>">Details</a>
			</td>
		<?php
		}
		echo "</tr>";
	}

}

?>
</table>
</fieldset>

</form>
</body>
</html>
<?php 
include('Footer1.php');
 ?>