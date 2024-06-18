<!DOCTYPE html>
<html>
<head>
<title>Menu</title>
    <link rel="stylesheet" type="text/css" href="menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <a href="http://localhost/dbdine/Restaurant/menu/new_item.php">Insert new item</a>
 
</div>

<div class="content">
  <h2>Menu</h2>
  
  <?php
session_start();
include("../../admin/db.php");

if (!isset($_SESSION['Restaurant_ID'])) {
    header("Location: ../../login/login.php");
    exit();
}

$Restaurant_ID = $_SESSION['Restaurant_ID'];

$sql = "SELECT * FROM Menu WHERE Restaurant_ID = ?";
$stmt1 = $conn->prepare($sql);
if (!$stmt1) {
    die("Error preparing statement: " . $conn->error);
}
$stmt1->bind_param("i", $Restaurant_ID);
$stmt1->execute();
$result1 = $stmt1->get_result();

echo "<table border='1'>";
echo "<tr><th>Item No.</th>
          <th>Item Name</th>
          <th>Price</th>
          <th>Description</th>
          <th>Action</th>
          </tr>";
while ($row = $result1->fetch_assoc()) {
    echo "<tr>
    <td>".$row["Item_Number"]."</td>
    <td>".$row["Item_Name"]."</td>
    <td>".$row["price"]."</td>
    <td>".$row["Description"]."</td>
    <td>
    <button><a href='./update.php?Item_Number=".$row["Item_Number"]."'>Update</a></button>
    <button><a href='./delete.php?Item_Number=".$row["Item_Number"]."'>Delete</a></button>
</td>
    </tr>";
}
echo "</table>";

$stmt1->close();
$conn->close();
?>

</div>

</body>
</html>

