<!DOCTYPE html>
<html>
<head>
<title>Reservations</title>
    <link rel="stylesheet" type="text/css" href="reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>  
  <a href="http://localhost/dbdine/Restaurant/reservation/reservation_add.php">Add Reservation</a>
</div>

<div class="content">
  <h2>Reservations</h2>
  
  <?php
   include("../../admin/db.php");
   session_start();

   if (!isset($_SESSION['Restaurant_ID'])) {
       header("Location: ../../login/login.php");
       exit();
   }

   $restaurant_id = $_SESSION['Restaurant_ID'];

$sql = "SELECT * FROM reservation where Restaurant_ID = ? ";

$stmt1 = $conn->prepare($sql);

if(!$stmt1) {
    die("Error preparing statement: " . $conn->error);
}
$stmt1->bind_param("i", $restaurant_id);

$stmt1->execute();

$result1 = $stmt1->get_result();
echo "<table border='1'>";
echo "<tr> <th>Reservation ID</th>
        <th>Name</th>
        <th>Total Guests</th>
        <th>Reservation Date</th>
        <th>Action</th>
        </tr>";
        
while($row = $result1->fetch_assoc()) {
    echo "<tr>
    <td>".$row["Reservation_ID"]."</td>
    <td>".$row["Name"]."</td>
    <td>".$row["Total_Guests"]."</td>
    <td>".$row["Reservation_Date"]."</td>
    <td>
    <button><a href='./reservation_update.php?Reservation_ID=$row[Reservation_ID]'>Update</a></button>
    <button><a href='./reservation_delete.php?Reservation_ID=$row[Reservation_ID]'>Delete</a></button>
</td>
    </tr>";
}
echo "</table>";

$stmt1->close();

  ?>
</div>

</body>
</html>

