<?php
include("../../admin/db.php");

$Reservation_ID = "";
$Name = "";
$Total_Guests = "";
$Reservation_Date = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["Reservation_ID"])) {
        echo "Reservation ID is required";
        exit;
    }

    $Reservation_ID = $_GET["Reservation_ID"];

    $sql = "SELECT * FROM reservation WHERE Reservation_ID=$Reservation_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
       echo "Reservation not found";
        exit;
    }

    $Name = $row["Name"];
    $Total_Guests = $row["Total_Guests"];
    $Reservation_Date = $row["Reservation_Date"];


} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Reservation_ID = $_POST["Reservation_ID"];
    $Name = $_POST["Name"];
    $Total_Guests = $_POST["Total_Guests"];
    $Reservation_Date = $_POST["Reservation_Date"];
   

    if (empty($Reservation_ID) || empty($Name) || empty($Total_Guests) || empty($Reservation_Date) ) {
        $errorMessage = "All fields are required!";
    }
    $sql = "UPDATE reservation SET `Name` = '$Name', 
                   `Total_Guests`='$Total_Guests',
                   `Reservation_Date`='$Reservation_Date'
             
               WHERE Reservation_ID='$Reservation_ID'";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    }
    $conn->close();
    header("location: ./reservation.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
    <link rel="stylesheet" href="reservation_add.css">
</head>
<body>

<div class="container">
    <h2>Update Reservation</h2>

    <form method="post">

        <input type="hidden" name="Reservation_ID" value="<?php echo $Reservation_ID; ?>">

        <label for="Name">Name:</label>
        <input type="text" name="Name" id="Name" value="<?php echo $Name; ?>">

        <label for="Total_Guests">Total Guests:</label>
        <input type="number" name="Total_Guests" id="Total_Guests" value="<?php echo $Total_Guests; ?>">

        <label for="Reservation_Date">Reservation Date:</label>
        <input type="date" name="Reservation_Date" id="Reservation_Date" value="<?php echo $Reservation_Date; ?>">


        <input type="submit" value="Update">


    </form>
</div>



</body>
</html>