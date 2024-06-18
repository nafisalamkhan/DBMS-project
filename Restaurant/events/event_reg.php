<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New event</title>
    <link rel="stylesheet" href="event_reg.css">
</head>
<body>
    
    <form action="event_reg.php" method="post">
        <h2>New Event</h2>
        <label for="eventtype">Event Type:</label>
        <input type="text" id="eventtype" name="eventtype" required><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required><br><br>

        <label for="totalguests">Total Guests:</label>
        <input type="number" id="totalguests" name="totalguests" required><br><br>

        <input type="submit" value="Add">
    </form>

    <?php
    session_start();
    include('../../admin/db.php'); 
    
    if (!isset($_SESSION['Restaurant_ID'])) {
        header("Location: ../../login/login.php");
        exit();
    }
    
    $Restaurant_ID = $_SESSION['Restaurant_ID'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $eventtype = isset($_POST['eventtype']) ? $_POST['eventtype'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        $totalguests = isset($_POST['totalguests']) ? $_POST['totalguests'] : '';

        
        
         $sql = "INSERT INTO Eventss (Event_Type, Date, Time, Total_Guests, Restaurant_ID)
                VALUES ('$eventtype', '$date', '$time', '$totalguests', '$Restaurant_ID')";

        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    
    $conn->close();
    ?>

</body>
</html>
