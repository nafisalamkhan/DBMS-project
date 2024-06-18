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
  <a href="http://localhost/dbdine/Restaurant/orders/order_deliver.php">Delivered Orders</a>
  <a href="http://localhost/dbdine/Restaurant/orders/order_cancel.php">Canceled Orders</a>
</div>

<div class="content">
  <h2>Orders</h2>

  <?php
session_start();
include("../../admin/db.php");

if (!isset($_SESSION['Restaurant_ID'])) {
    header("Location: ../../login/login.php");
    exit();
}

$Restaurant_ID = $_SESSION['Restaurant_ID'];

if (isset($_GET['action']) && isset($_GET['Order_ID'])) {
    $Order_ID = intval($_GET['Order_ID']);

    if ($_GET['action'] == 'deliver') {
        $sql_deliver = "INSERT INTO delivers (Order_ID, Quantity, Delivery_Date, sub_total,  Customer_ID, Restaurant_ID)
                        SELECT Order_ID, Quantity, order_date, sub_total,  Customer_ID, Restaurant_ID 
                        FROM orders
                        WHERE Order_ID = ?";
        $stmt_deliver = $conn->prepare($sql_deliver);
        $stmt_deliver->bind_param("i", $Order_ID);
        if ($stmt_deliver->execute()) {
            echo "Order delivered successfully.";
        } else {
            echo "Error delivering order: " . $stmt_deliver->error;
        }
        $stmt_deliver->close();
    }

    if ($_GET['action'] == 'cancel') {
        $sql_cancel = "INSERT INTO canceled (Order_ID, Date_Time, Restaurant_ID, Customer_ID)
                       SELECT Order_ID, order_date, Restaurant_ID, Customer_ID
                        FROM orders
                        WHERE Order_ID = ?";
        $stmt_cancel = $conn->prepare($sql_cancel);
        $stmt_cancel->bind_param("i", $Order_ID);
        if ($stmt_cancel->execute()) {
            echo "Order canceled successfully.";
        } else {
            echo "Error canceling order: " . $stmt_cancel->error;
        }
        $stmt_cancel->close();
    }
}



   $sql = "SELECT * FROM orders WHERE Restaurant_ID = ? ORDER BY Order_ID desc";

   $stmt1 = $conn->prepare($sql);
   if (!$stmt1) {
       die("Error preparing statement: " . $conn->error);
   }
   $stmt1->bind_param("i", $Restaurant_ID);
   $stmt1->execute();
   $result1 = $stmt1->get_result();

   echo "<table border='1'>";
   echo "<tr><th>Order ID</th>
           <th>Quantity</th>
           <th>Order Date</th>
           <th>Subtotal</th>
           <th>Customer ID</th>
           <th>Item Number</th>
           <th>Restaurant ID</th>
           <th>Action</th>
           </tr>";

   while ($row = $result1->fetch_assoc()) {
       echo "<tr>
       <td>".$row["Order_ID"]."</td>
       <td>".$row["Quantity"]."</td>
       <td>".$row["order_date"]."</td>
       <td>".$row["sub_total"]."</td>
       <td>".$row["Customer_ID"]."</td>
       <td>".$row["Item_Number"]."</td>
       <td>".$row["Restaurant_ID"]."</td>
       <td>
       <button><a href='./orders.php?action=deliver&Order_ID=".$row["Order_ID"]."'>Deliver</a></button>
       <button><a href='./orders.php?action=cancel&Order_ID=".$row["Order_ID"]."'>Cancel</a></button>
   </td>
       </tr>";
   }
   echo "</table>";

   $stmt1->close();
  ?>
</div>

</body>
</html>