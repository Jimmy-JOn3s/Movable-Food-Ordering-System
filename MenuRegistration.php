<?php 
$connection=mysqli_connect("localhost","root","","l5dc_cp");
include('Header2.php');
if (isset($_POST['btnregister'])) {
	$folder="../Images/";
	$MenuPhoto=$_FILES['txtmenuphoto']['name'];
	if ($MenuPhoto) {
		$filename=$folder.$MenuPhoto;
		$copy=copy($_FILES['txtmenuphoto']['tmp_name'],$filename);
		if (!$copy) {
			exit();
		}
	}
	$Menu=$_POST['txtmenu'];
	$FoodType=$_POST['cboType'];
	$Price=$_POST['txtprice'];
	$insert="INSERT INTO Menu (MenuPhoto,Menu,FoodTypeID,Price) VALUES ('$filename','$Menu','$FoodType','$Price')";
	$result=mysqli_query($connection,$insert);
	if ($result) {
		echo "<script>alert('Menu register successful.');</script>";
		echo "<script>window.location='MenuRegistration.php'</script>";
	}
	else{
				echo "<script>alert('Cannot Register.');</script>";
				

	}

}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="MenuRegistration.php" method="Post" enctype="multipart/form-data">
	<fieldset >
	<legend align="center">Menu Display</legend>

		<table align="center">
			<tr>
				<td>MenuPhoto</td>
				<td><input type="file" name="txtmenuphoto" placeholder="" required ></td>
			</tr>
			<tr>
				<td>Menu</td>
				<td><input type="text" name="txtmenu" placeholder="" required></td>
			</tr>
			<tr>
				<td>FoodType</td>
				<td>
					<select name="cboType">
						<?php 
							$select="SELECT * FROM foodtype";
							$result1=mysqli_query ($connection,$select);
							if ($result1) {
								$count=mysqli_num_rows($result1);
								for ($i=0; $i < $count; $i++) { 
									$arr=mysqli_fetch_array($result1);
									echo "<option value='".$arr['FoodTypeID']."'>".$arr['Type']."</option>";
								}
								
							}
						 ?>
						<option></option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Price</td>
				<td><input type="number" name="txtprice" placeholder="" required ></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="btnregister" value="Register"></td>
			</tr>
		</table>
	</fieldset>
	</form>
</body>
</html>
<?php include('Footer1.php'); ?>