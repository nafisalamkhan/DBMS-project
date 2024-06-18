<!DOCTYPE html>
<html>
<head>
<title>Reviews</title>
    <link rel="stylesheet" type="text/css" href="reviews.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a> 
  <a href="http://localhost/dbdine/Restaurant/reviews/review_search.php">Search review</a> 
</div>

<div class="content">
  <h2>Reviews</h2>
  
  <?php
   include("../../admin/db.php");
   session_start();

   if (!isset($_SESSION['Restaurant_ID'])) {
       header("Location: ../../login/login.php");
       exit();
   }

   $restaurant_id = $_SESSION['Restaurant_ID'];


$sql = "SELECT * FROM review where Restaurant_ID = ? ";

$stmt1 = $conn->prepare($sql);

if(!$stmt1) {
    die("Error preparing statement: " . $conn->error);
}
$stmt1->bind_param("i", $restaurant_id);
$stmt1->execute();
$result1 = $stmt1->get_result();

echo "<table border='1'>";
echo "<tr><th>Rating</th>
        <th>Comments</th>
        <th>Review_Date</th>
        <th>Customer_ID</th>
        <th>Order_ID</th>
        </tr>";
        
while($row = $result1->fetch_assoc()) {
    echo "<tr>
    <td>".$row["Rating"]."</td>
    <td>".$row["Comments"]."</td>
    <td>".$row["Review_Date"]."</td>
    <td>".$row["Customer_ID"]."</td>
    <td>".$row["Order_ID"]."</td>
    </tr>";
}
echo "</table>";

$stmt1->close();

  ?>
</div>

</body>
</html>

