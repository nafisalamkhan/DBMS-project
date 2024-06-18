

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Employee Table</title>
    <link rel="stylesheet" type="text/css" href="employee_table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <a href="http://localhost/dbdine/Restaurant/employee/employee.php">Insert new record</a>
  <a href="http://localhost/dbdine/Restaurant/employee/shift.php">Shift</a>
  <a href="http://localhost/dbdine/Restaurant/employee/employee_search.php">Search</a>
 
</div>

<div class="content">
  <h2>Employee Information</h2>
  
  <?php
session_start();
include("../../admin/db.php");

if (!isset($_SESSION['Restaurant_ID'])) {
    header("Location: ../../login/login.php");
    exit();
}

$Restaurant_ID = $_SESSION['Restaurant_ID'];

$sql = "SELECT * FROM Employee WHERE Restaurant_ID = ?";

$stmt1 = $conn->prepare($sql);
if (!$stmt1) {
    die("Error preparing statement: " . $conn->error);
}
$stmt1->bind_param("i", $Restaurant_ID);
$stmt1->execute();
$result1 = $stmt1->get_result();

echo "<table border='1'>";
echo "<tr><th>Employee ID</th>
<th>Name</th><th>Address</th>
<th>Phone</th><th>Email</th>
<th>Position</th>
<th>Salary</th>
<th>Restaurant ID</th>
<th>Action</th>
</tr>";
while ($row = $result1->fetch_assoc()) {
  echo "<tr>
  <td>".$row['Employee_ID']."</td>
  <td>".$row['Name']."</td>
  <td>".$row['Address']."</td>
  <td>".$row['Phone']."</td>
  <td>".$row['Email']."</td>
  <td>".$row['Position']."</td>
  <td>".$row['salary']."</td>
  <td>".$row['Restaurant_ID']."</td>
  <td>
      <button><a href='./employee_update.php?Employee_ID=".$row['Employee_ID']."'>Update</a></button>
      <button><a href='./employee_delete.php?Employee_ID=".$row['Employee_ID']."'>Delete</a></button>
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

