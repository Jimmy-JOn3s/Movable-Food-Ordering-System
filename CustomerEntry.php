<?php  
session_start();
include('connection.php');
include('Header1.php');
if(isset($_POST['btnSave'])) 
{
  $txtCName=$_POST['txtCName'];
  $txtEmail=$_POST['txtEmail'];
  $txtPhone=$_POST['txtPhone'];
  $txtPassword=$_POST['txtPassword'];
  $txtAddress=$_POST['txtAddress'];

  //Check Email already exist coding
  $checkEmail="SELECT * FROM Customer 
        WHERE Email='$txtEmail'";
  $ret=mysqli_query($connection,$checkEmail);
  $count=mysqli_num_rows($ret);

  if($count > 0) 
  {
    echo "<script>window.alert('Email address $txtEmail already exist!')</script>";
    echo "<script>window.location='CustomerEntry.php'</script>";
  }
  else
  {
    $InsertCustomer="INSERT INTO Customer
            (Name,Email,Password,Phone,Address)
            VALUES 
            ('$txtCName','$txtEmail','$txtPassword','$txtPhone','$txtAddress')";
    $ret=mysqli_query($connection,$InsertCustomer);

    if($ret) 
    {
      echo "<script>window.alert('Customer Account Created!')</script>";
      echo "<script>window.location='CustomerLogin.php'</script>";
    }
    else
    {
      echo "<p>Something went wrong in Customer Entry " . mysqli_errno($connection) . "</p>";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
 
</head>
<body>
<link rel="stylesheet" type="text/css" href="owncss.css">
<form action="CustomerEntry.php" method="POST">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="info"><b>CustomerName</b></label>
    <input type="text" placeholder="Enter Name" name="txtCName" id="" required>

     <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="txtEmail" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="txtPassword" id="psw" required>

     <label for="info"><b>Phone</b></label>
    <input type="text" placeholder="Enter Phone" name="txtPhone" id="" required>

     <label for="info"><b>Address</b></label>
    <input type="text" placeholder="Enter Address" name="txtAddress" id="" required>

    <hr>

    
    <input type="submit" class="registerbtn" name="btnSave" value="Save" />
    <input type="reset" class="registerbtn" value="Cancel" />
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="CustomerLogin.php">Sign in</a>.</p>
  </div>
  <table align="center" id="tableid" class="display">
<thead>
  <tr>
    <th>#</th>
    <th>CustomerID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Action</th>
  </tr> 
</thead>  
<tbody>
<?php  
$query="SELECT * FROM Customer";
$ret=mysqli_query($connection,$query);
$count=mysqli_num_rows($ret);

for ($i=0;$i<$count;$i++) 
{ 
  $arr=mysqli_fetch_array($ret);

  $CustomerID=$arr['CustomerID'];
  $Name=$arr['Name'];

  echo "<tr>";
    echo "<td>" . ($i + 1) . "</td>";
    echo "<td>" . $CustomerID . "</td>";
    echo "<td>" . $Name . "</td>";
    echo "<td>" . $arr['Email'] . "</td>";
    echo "<td>" . $arr['Phone'] . "</td>";
    echo "<td>" . $arr['Address'] . "</td>";
    
    echo "<td>
        <a href='CustomerUpdate.php?CustomerID=$CustomerID'>Edit</a>
        <a href='CustomerDelete.php?CustomerID=$CustomerID'>Delete</a>
        </td>";
  echo "</tr>"; 
}
?>
</tbody>
</table>
</form>

</body>
</html>
<?php include('Footer1.php'); ?>