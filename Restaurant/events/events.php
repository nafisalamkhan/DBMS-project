


<!DOCTYPE html>
<html>
<head>
<title>Events</title>
    <link rel="stylesheet" type="text/css" href="events.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <a href="http://localhost/dbdine/Restaurant/events/event_reg.php">Insert new event</a>
  <a href="http://localhost/dbdine/Restaurant/events/event_search.php">Search</a> 
</div>

<div class="content">
  <h2>Event Information</h2>
  
  <?php
    session_start();
    include("../../admin/db.php");
    
    if (!isset($_SESSION['Restaurant_ID'])) {
        header("Location: ../../login/login.php");
        exit();
    }
    
    $Restaurant_ID = $_SESSION['Restaurant_ID'];

$sql = "SELECT * FROM Eventss where Restaurant_ID = ? ORDER BY Event_ID DESC";

$stmt1 = $conn->prepare($sql);

if(!$stmt1) {
    die("Error preparing statement: " . $conn->error);
}

$stmt1->bind_param("i", $Restaurant_ID);
$stmt1->execute();
$result1 = $stmt1->get_result();

echo "<table border='1'>";
echo "<tr>
<th>Event ID</th>
<th>Event Type</th>
<th>Date</th>
<th>Time</th>
<th>Total Guests</th>
<th>Action</th>
</tr>";
while($row = $result1->fetch_assoc()) {
    echo "<tr>
    <td>".$row["Event_ID"]."</td>
    <td>".$row["Event_Type"]."</td>
    <td>".$row["Date"]."</td>
    <td>".$row["Time"]."</td>
    <td>".$row["Total_Guests"]."</td>
    <td>
    <button><a href='./event_update.php?Event_ID=$row[Event_ID]'>Update</a></button>
    <button><a href='./event_delete.php?Event_ID=$row[Event_ID]'>Delete</a></button>
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

