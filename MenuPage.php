<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table border="1">
	<?php 
	$connect=mysqli_connect("localhost","root","","l5dc_cp");
		$select="SELECT * FROM Menu";
	$result =mysqli_query($connect,$select);
	if ($result ) {
		$count=mysqli_num_rows($result);
				for ($i=0; $i < $count ; $i++) { 
					$arr=mysqli_fetch_array($result);
					
					echo "<td><img src='".$arr['MenuPhoto']."'width='150px '>
					<br>
					<a href='MenuDetail.php?PID=".$arr['ProductID']."'>"
					.$arr['Menu']."</a>;
					<br>
					".$arr['Price']."
					</td>";
				
					
				
	}
    }
	else{
		echo mysqli_error ($connection);
	}
	 ?>
	 
</table>
</body>
</html>