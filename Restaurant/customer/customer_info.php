<!DOCTYPE html>
<html>
<head>
<title>Customer Table</title>
    <link rel="stylesheet" type="text/css" href="customer_info.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <a href="http://localhost/dbdine/Restaurant/customer/customer_search.php">Search</a>
</div>

<div class="content">
  <h2>Customer Information</h2>
  
  <?php
    include("../../admin/db.php");
    session_start();

    if (!isset($_SESSION['Restaurant_ID'])) {
        header("Location: ../../login/login.php");
        exit();
    }

    $restaurant_id = $_SESSION['Restaurant_ID'];

    $sql = "SELECT * FROM customer WHERE Restaurant_ID = ? ORDER BY Customer_ID DESC";
    $stmt = $conn->prepare($sql);

    if(!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<table border='1'>";
    echo "<tr>
    <th>Customer ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Address</th>
    <th>Gender</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["Customer_ID"]."</td>
        <td>".$row["First Name"]."</td>
        <td>".$row["Last Name"]."</td>
        <td>".$row["Phone"]."</td>
        <td>".$row["Email"]."</td>
        <td>".$row["Address"]."</td>
        <td>".$row["Gender"]."</td>
        </tr>";
    }
    echo "</table>";

    $stmt->close();
    $conn->close();
  ?>
</div>

</body>
</html>
