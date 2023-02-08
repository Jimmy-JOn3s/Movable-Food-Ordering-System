<?php  
session_start();
include('Header2.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Home</title>
</head>
<body>
<form align="center">
<p>
Welcome : <?php echo $_SESSION['StaffName'] ?> | <?php echo $_SESSION['Role'] ?> | <a href="StaffLogout.php">Logout</a>
</p>

<ul>
	<li><a href="StaffEntry.php">Manage Staff</a></li>
	<li><a href="MenuRegistration.php">Manage Menu</a></li>
	<li><a href="ItemOrder.php">Manage Item</a></li>
</ul>

</form>
</body>
</html>
<?php include('Footer1.php') ?>