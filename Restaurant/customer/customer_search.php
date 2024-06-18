<!DOCTYPE html>
<html>
<head>
<title>Customer Search</title>
    <link rel="stylesheet" type="text/css" href="customer_search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <div class="search-container">
    <form action="" method="GET">
      <input type="text" placeholder="Search by Customer ID" name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
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

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
        $customer_id = $_GET['search'];

        $sql = "SELECT * FROM Customer WHERE Customer_ID = ? AND Restaurant_ID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $customer_id, $restaurant_id);
        $stmt->execute();
        $result1 = $stmt->get_result();

        if ($result1->num_rows > 0) {
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
            while($row = $result1->fetch_assoc()) {
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
        } else {
            echo "No customer found with the given ID.";
        }
    } 

    $conn->close();
  ?>
</div>

</body>
</html>
