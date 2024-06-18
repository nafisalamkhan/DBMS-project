<?php
include("../../admin/db.php");

$Event_ID = "";
$Event_Type = "";
$Date = "";
$Time = "";
$Total_Guests = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["Event_ID"])) {
        echo "Event ID is required";
        exit;
    }

    $Event_ID = $_GET["Event_ID"];

    $sql = "SELECT * FROM eventss WHERE Event_ID=$Event_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
       echo "Item not found";
        exit;
    }

    $Event_Type = $row["Event_Type"];
    $Date = $row["Date"];
    $Time = $row["Time"];
    $Total_Guests = $row["Total_Guests"];
    
    

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Event_ID = $_POST["Event_ID"];
    $Event_Type = $_POST["Event_Type"];
    $Date = $_POST["Date"];
    $Time = $_POST["Time"];
    $Total_Guests = $_POST["Total_Guests"];
   

    if (empty($Event_ID) || empty($Event_Type) || empty($Date) || empty($Time) || empty($Total_Guests) ) {
        $errorMessage = "All fields are required!";
    }
    $sql = "UPDATE eventss SET `Event_Type` = '$Event_Type', 
                   `Date`='$Date',
                   `Time`='$Time',
                   `Total_Guests`='$Total_Guests'
             
               WHERE Event_ID='$Event_ID'";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    }
    $conn->close();
    header("location: ./events.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="event_reg.css">
</head>
<body>

<div class="container">
    <h2>Update Event</h2>

    <form method="post">

        <input type="hidden" name="Event_ID" value="<?php echo $Event_ID; ?>">

        <label for="Event_Type">Event Type:</label>
        <input type="text" name="Event_Type" id="Event_Type" value="<?php echo $Event_Type; ?>">

        <label for="Date">Date:</label>
        <input type="date" name="Date" id="Date" value="<?php echo $Date; ?>">

        <label for="Time">Time:</label>
        <input type="time" name="Time" id="Time" value="<?php echo $Time; ?>">

        <label for="Total_Guests">Total Guests:</label>
        <input type="number" name="Total_Guests" id="Total_Guests" value="<?php echo $Total_Guests; ?>">


        <input type="submit" value="Update">


    </form>
</div>



</body>
</html>