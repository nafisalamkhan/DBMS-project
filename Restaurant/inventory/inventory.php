<!DOCTYPE html>
<html>
<head>
<title>Inventory</title>
    <link rel="stylesheet" type="text/css" href="inventory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>  
  <a href="http://localhost/dbdine/Restaurant/inventory/in_add.php">Add New Inventory Item</a>
</div>

<div class="content">
  <h2>Inventory Details</h2>
  
  <?php
   session_start();
   include("../../admin/db.php");
   
   if (!isset($_SESSION['Restaurant_ID'])) {
       header("Location: ../../login/login.php");
       exit();
   }
   
   $Restaurant_ID = $_SESSION['Restaurant_ID'];
   
$sql = "SELECT * FROM inventory where Restaurant_ID = ?";

$stmt1 = $conn->prepare($sql);

if(!$stmt1) {
    die("Error preparing statement: " . $conn->error);
}
$stmt1->bind_param("i", $Restaurant_ID);
$stmt1->execute();
$result1 = $stmt1->get_result();

echo "<table border='1'>";
echo "<tr><th>Product ID</th>
        <th>Product Name</th>
        <th>Catagory</th>
        <th>Quantity</th>
        <th>Expiration Date</th>
        <th>Action</th>
        </tr>";
        
while($row = $result1->fetch_assoc()) {
    echo "<tr>
    <td>".$row["Product_ID"]."</td>
    <td>".$row["Product_Name"]."</td>
    <td>".$row["Catagory"]."</td>
    <td>".$row["Quantity"]."</td>
    <td>".$row["Expiration_Date"]."</td>
    <td>
    <button><a href='./inventory_update.php?Product_ID=$row[Product_ID]'>Update</a></button>
    <button><a href='./inventory_delete.php?Product_ID=$row[Product_ID]'>Delete</a></button>
</td>
    </tr>";
}
echo "</table>";

$stmt1->close();

  ?>
</div>

</body>
</html>

