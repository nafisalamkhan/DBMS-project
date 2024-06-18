<!DOCTYPE html>
<html>
<head>
<title>Event Search</title>
    <link rel="stylesheet" type="text/css" href="event_search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="topnav">
  <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php">Dashboard</a>
  <a href="http://localhost/dbdine/Restaurant/events/event_reg.php">Insert new event</a>
  <div class="search-container">
    <form action="" method="GET">
      <input type="text" placeholder="Search by Event ID" name="search">


   
      <a href="http://localhost/dbdine/Restaurant/events/event_search.php">
       <button type="submit">
       <i class="fa fa-search"></i>
       </button>
      </a>

    </form>
  </div>
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

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
        $event_id = $_GET['search'];

        $sql = "SELECT * FROM Eventss WHERE Event_ID = ? and Restaurant_ID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $event_id, $Restaurant_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>
            <th>Event ID</th>
            <th>Event Type</th>
            <th>Date</th>
            <th>Time</th>
            <th>Total Guests</th>
            </tr>";
            while($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>".$row["Event_ID"]."</td>
                    <td>".$row["Event_Type"]."</td>
                    <td>".$row["Date"]."</td>
                    <td>".$row["Time"]."</td>
                    <td>".$row["Total_Guests"]."</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No event found with the given ID.";
        }
    } 
    $conn->close();
    

  ?>
</div>

</body>
</html>

