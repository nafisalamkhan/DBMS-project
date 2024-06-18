<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Supplier</title>
    <link rel="stylesheet" type="text/css" href="suppliers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a> 
  <a href="http://localhost/dbdine/Restaurant/supplier/supplier_add.php">Add Supplier</a> 
</div>

<div class="content">
  <h2>Supplier Details</h2>
  
  <?php
    session_start();
    include("../../admin/db.php");
    
    if (!isset($_SESSION['Restaurant_ID'])) {
        header("Location: ../../login/login.php");
        exit();
    }
    
    $Restaurant_ID = $_SESSION['Restaurant_ID'];
    

$sql = "SELECT * FROM supplier where Restaurant_ID = ?";

$stmt1 = $conn->prepare($sql);

if(!$stmt1) {
    die("Error preparing statement: " . $conn->error);
}

$stmt1->bind_param("i", $Restaurant_ID);
$stmt1->execute();
$result1 = $stmt1->get_result();
echo "<table border='1'>";
echo "<tr><th>Marchent_ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Action</th>
        </tr>";
        
while($row = $result1->fetch_assoc()) {
    echo "<tr>
    <td>".$row["Marchent_ID"]."</td>
    <td>".$row["Name"]."</td>
    <td>".$row["Address"]."</td>
    <td>".$row["Phone"]."</td>
    <td>".$row["Email"]."</td>
    <td>
    <button><a href='./supplier_update.php?Marchent_ID=$row[Marchent_ID]'>Update</a></button>
    <button><a href='./supplier_delete.php?Marchent_ID=$row[Marchent_ID]'>Delete</a></button>
</td>
    </tr>";
}
echo "</table>";

$stmt1->close();

  ?>
</div>

</body>
</html>

