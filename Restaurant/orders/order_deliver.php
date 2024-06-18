<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Delivered Orders</title>
<link rel="stylesheet" type="text/css" href="orders.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <a href="http://localhost/dbdine/Restaurant/orders/orders.php">Orders</a>
  <a href="http://localhost/dbdine/Restaurant/orders/order_cancel.php">Canceled Orders</a>
</div>

<div class="content">
  <h2>Delivered Orders</h2>

  <?php
  session_start();
  include("../../admin/db.php");

  if (!isset($_SESSION['Restaurant_ID'])) {
      header("Location: ../../login/login.php");
      exit();
  }

  $Restaurant_ID = $_SESSION['Restaurant_ID'];

  $sql = "SELECT * FROM delivers WHERE Restaurant_ID = ?";
  $stmt1 = $conn->prepare($sql);
  if (!$stmt1) {
      die("Error preparing statement: " . $conn->error);
  }
  $stmt1->bind_param("i", $Restaurant_ID);
  $stmt1->execute();
  $result1 = $stmt1->get_result();

  echo "<table border='1'>";
  echo "<tr><th>Delivery Date</th>
  <th>Order ID</th>
  <th>Restaurant ID</th>
  <th>Customer ID</th>
  </tr>";
  while ($row = $result1->fetch_assoc()) {
    echo "<tr>
    <td>".$row['Delivery_Date']."</td>
    <td>".$row['Order_ID']."</td>
    <td>".$row['Restaurant_ID']."</td>
    <td>".$row['Customer_ID']."</td>
    </tr>";
  }
  echo "</table>";

  $stmt1->close();
  $conn->close();
  ?>
</div>

</body>
</html>