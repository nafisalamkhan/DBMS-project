


<!DOCTYPE html>
<html>
<head>
<title>Shift</title>
    <link rel="stylesheet" type="text/css" href="shift.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <a href="http://localhost/dbdine/Restaurant/employee/shift_add.php">Insert new shift</a>
  <a href="http://localhost/dbdine/Restaurant/employee/shift_search.php">Search</a>
 
</div>

<div class="content">
  <h2>Employee Shift</h2>
  
  <?php
   session_start();
    include("../../admin/db.php");

    if (!isset($_SESSION['Restaurant_ID'])) {
      header("Location: ../../login/login.php");
      exit();
  }
  
  $Restaurant_ID = $_SESSION['Restaurant_ID'];

  $sql = "SELECT * FROM `shift` 
        WHERE Employee_ID IN(SELECT Employee_ID FROM Employee WHERE Restaurant_ID = ?)
        ORDER BY Shift_ID DESC";

$stmt1 = $conn->prepare($sql);

if(!$stmt1) {
    die("Error preparing statement: " . $conn->error);
}

$stmt1->bind_param("i", $Restaurant_ID);
$stmt1->execute();
$result1 = $stmt1->get_result();
$stmt1->execute();
$result1 = $stmt1->get_result();

echo "<table border='1'>";
echo "<tr>
<th>Shift ID</th>
<th>Shift Date</th>
<th>Start_Time</th>
<th>End_Time</th>
<th>Employee_ID</th>
<th>Action</th>
</tr>";
while($row = $result1->fetch_assoc()) {
    echo "<tr>
    <td>".$row["Shift_ID"]."</td>
    <td>".$row["Shift_Date"]."</td>
    <td>".$row["Start_Time"]."</td>
    <td>".$row["End_Time"]."</td>
    <td>".$row["Employee_ID"]."</td>
    <td>
    <button><a href='./shift_update.php?Shift_ID=$row[Shift_ID]'>Update</a></button>
    <button><a href='./shift_delete.php?Shift_ID=$row[Shift_ID]'>Delete</a></button>
</td>
    </tr>";
}
echo "</table>";

$stmt1->close();


  ?>
</div>

</body>
</html>

