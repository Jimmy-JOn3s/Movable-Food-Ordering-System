<?php  
session_start();
include('Header1.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Home</title>
</head>
<body>
<form>
<p>
Welcome : <?php echo $_SESSION['Name'] ?> |  <a href="CustomerLogout.php">Logout</a>
</p>

<ul>
	<li><a href="MenuDisplay.php">Menu Display</a></li>
	<li><a href="CustomerUpdate.php">Update</a></li>
	<li><a href="CustomerDelete.php">Delete</a></li>
</ul>

</form>
</body>
</html>
<?php include('Footer1.php'); ?>