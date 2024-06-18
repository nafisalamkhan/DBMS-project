


<!DOCTYPE html>
<html>
<head>
<title>Shift Search</title>
    <link rel="stylesheet" type="text/css" href="employee_search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <a href="http://localhost/dbdine/Restaurant/employee/shift_add.php">Insert new shift</a>
  <div class="search-container">
    <form action="" method="GET">
      <input type="text" placeholder="Search by Employee ID" name="search">


   
      <a href="http://localhost/dbdine/Restaurant/employee/shift_search.php">
       <button type="submit">
       <i class="fa fa-search"></i>
       </button>
      </a>

    </form>
  </div>
</div>

<div class="content">
  <h2>Shifts</h2>
  
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

        $sql = "SELECT * FROM Shift 
                WHERE Employee_ID = ? 
                AND Employee_ID IN (SELECT Employee_ID FROM Employee WHERE Restaurant_ID = ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $employee_id, $Restaurant_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
           echo "<table border='1'>";
           echo "<tr><th>Shift ID</th><th>Shift Date</th><th>Start_Time</th><th>End_Time</th><th>Employee_ID</th></tr>";
           while($row = $result->fetch_assoc()) {
               echo "<tr><td>".$row["Shift_ID"]."</td><td>".$row["Shift_Date"]."</td><td>".$row["Start_Time"]."</td><td>".$row["End_Time"]."</td><td>".$row["Employee_ID"]."</td></tr>";
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

