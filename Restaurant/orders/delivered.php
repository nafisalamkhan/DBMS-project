<?php
session_start();
include("../../admin/db.php");

if (!isset($_SESSION['Restaurant_ID'])) {
    header("Location: ../../login/login.php");
    exit();
}

$Restaurant_ID = $_SESSION['Restaurant_ID'];

if(isset($_GET['action']) && $_GET['action'] == 'deliver' && isset($_GET['Order_ID'])) {
    $orderID = $_GET['Order_ID'];
    
    $update_sql = "UPDATE orders SET status = 'delivered' WHERE Order_ID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $orderID);
    $update_stmt->execute();
    
    $insert_sql = "INSERT INTO delivers (Order_ID, Quantity, order_date, sub_total, Customer_ID, Item_Number) SELECT Order_ID, Quantity, order_date, sub_total, Customer_ID, Item_Number FROM orders WHERE Order_ID = ?";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("i", $orderID);
    $insert_stmt->execute();
    
    header("Location: ./orders.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Orders</title>
    <link rel="stylesheet" type="text/css" href="orders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a> 
  <a href="http://localhost/dbdine/Restaurant/orders/order_cancel.php">Canceled Orders</a> 
</div>

<div class="content">
  <h2>Delivered Orders</h2>
  
  <?php
    include("../../admin/db.php");

    $sql = "SELECT * FROM delivers";

    $stmt1 = $conn->prepare($sql);

    if(!$stmt1) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt1->execute();

    $result1 = $stmt1->get_result();
    echo "<table border='1'>";
    echo "<tr><th>Delivery Date</th>
            <th>Order ID</th>
            <th>Restaurant ID</th>
            <th>Customer ID</th>
            </tr>";

    while($row = $result1->fetch_assoc()) {
        echo "<tr>
        <td>".$row["Delivery_Date"]."</td>
        <td>".$row["Order_ID"]."</td>
        <td>".$row["Restaurant_ID"]."</td>
        <td>".$row["Customer_ID"]."</td>
        </tr>";
    }
    echo "</table>";

    $stmt1->close();
  ?>
</div>

</body>
</html>
