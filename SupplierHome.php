<?php  
session_start();
include('Header3.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title>Supplier Home</title>
</head>
<body>
<form>
<p>
Welcome : <?php echo $_SESSION['SupllierName'] ?> | <?php echo $_SESSION['Role'] ?> | <a href="SupplierLogout.php">Logout</a>
</p>

<ul>
	<li><a href="SupplierEntry.php">Manage Supplier</a></li>
</ul>

</form>
</body>
</html>
<?php include('Footer1.php') ?>