<!DOCTYPE html>
<html>
<head>
<title>Review Search</title>
    <link rel="stylesheet" type="text/css" href="review_search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <div class="search-container">
    <form action="" method="GET">
      <input type="text" placeholder="Search by Order ID" name="search">


   
      <a href="http://localhost/dbdine/Restaurant/employee/employee_search.php">
       <button type="submit">
       <i class="fa fa-search"></i>
       </button>
      </a>

    </form>
  </div>
</div>

<div class="content">
  <h2>Review</h2>
  
  <?php
   include("../../admin/db.php");
   session_start();

   if (!isset($_SESSION['Restaurant_ID'])) {
       header("Location: ../../login/login.php");
       exit();
   }

   $restaurant_id = $_SESSION['Restaurant_ID'];


    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
        $Order_ID = $_GET['search'];

        $sql = "SELECT * FROM review WHERE Order_ID = ? AND Restaurant_ID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $Order_ID, $restaurant_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Rating</th>
            <th>Comments</th>
            <th>Review Date</th>
            <th>Customer ID</th>
            <th>Order ID</th>
            </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>".$row["Rating"]."</td>
                <td>".$row["Comments"]."</td>
                <td>".$row["Review_Date"]."</td>
                <td>".$row["Customer_ID"]."</td>
                <td>".$row["Order_ID"]."</td>
                </tr>";
            }
            
            echo "</table>";
        } else {
            echo "No review found with the given ID.";
        }
    } 

    $conn->close();
  ?>
</div>

</body>
</html>

