

<!DOCTYPE html>
<html>
<head>
<title>Employee Search</title>
    <link rel="stylesheet" type="text/css" href="employee_search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <a href="http://localhost/dbdine/Restaurant/employee/employee.php">Insert new record</a>
  <div class="search-container">
    <form action="" method="GET">
      <input type="text" placeholder="Search by Employee ID" name="search">


   
      <a href="http://localhost/dbdine/Restaurant/employee/employee_search.php">
       <button type="submit">
       <i class="fa fa-search"></i>
       </button>
      </a>

    </form>
  </div>
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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $employee_id = $_GET['search'];

    $sql = "SELECT * FROM Employee WHERE Employee_ID = ? AND Restaurant_ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $employee_id, $Restaurant_ID);
    $stmt->execute();
    $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Position</th>
            <th>salary</th>
            <th>Restaurant_ID</th>
            </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>".$row["Employee_ID"]."</td>
                <td>".$row["Name"]."</td>
                <td>".$row["Address"]."</td>
                <td>".$row["Phone"]."</td>
                <td>".$row["Email"]."</td>
                <td>".$row["Position"]."</td>
                <td>".$row["salary"]."</td>
                <td>".$row["Restaurant_ID"]."</td>
                </tr>";
            }
            
            echo "</table>";
        } else {
            echo "No employee found with the given ID.";
        }
    } 


  ?>
</div>

</body>
</html>

