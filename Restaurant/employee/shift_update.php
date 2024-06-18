<?php
session_start();
include("../../admin/db.php");

$Shift_ID = "";
$Shift_Date = "";
$Start_Time = "";
$End_Time = "";
$Employee_ID = "";

if (!isset($_SESSION['Restaurant_ID'])) {
    header("Location: ../../login/login.php");
    exit();
}

$Restaurant_ID = $_SESSION['Restaurant_ID'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["Shift_ID"])) {
        echo "Shift ID is required";
        exit;
    }

    $Shift_ID = $_GET["Shift_ID"];

    $sql = "SELECT * FROM shift WHERE Shift_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Shift_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
       echo "Shift ID is not found";
        exit;
    }

    $Shift_Date = $row["Shift_Date"];
    $Start_Time = $row["Start_Time"];
    $End_Time = $row["End_Time"];
    $Employee_ID = $row["Employee_ID"];

    $sql = "SELECT * FROM Employee WHERE Employee_ID=? AND Restaurant_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $Employee_ID, $Restaurant_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Invalid Employee ID for the logged-in user's restaurant.";
        exit;
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Shift_ID = $_POST["Shift_ID"];
    $Shift_Date = $_POST["Shift_Date"];
    $Start_Time = $_POST["Start_Time"];
    $End_Time = $_POST["End_Time"];
    $Employee_ID = $_POST["Employee_ID"];
   
    if (empty($Shift_ID) || empty($Shift_Date) || empty($Start_Time) || empty($End_Time) || empty($Employee_ID)) {
        $errorMessage = "All fields are required!";
        echo $errorMessage;
        exit;
    }

    $sql = "SELECT * FROM Employee WHERE Employee_ID=? AND Restaurant_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $Employee_ID, $Restaurant_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Invalid Employee ID for the logged-in user's restaurant.";
        exit;
    }

    $sql = "UPDATE shift SET Shift_Date=?, Start_Time=?, End_Time=?, Employee_ID=? WHERE Shift_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $Shift_Date, $Start_Time, $End_Time, $Employee_ID, $Shift_ID);
    $result = $stmt->execute();

    if (!$result) {
        die("Invalid query: " . $stmt->error);
    }
    $conn->close();
    header("location: ./shift.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Shift</title>
    <link rel="stylesheet" href="employee_update.css">
</head>
<body>

<div class="container">
    <h2>Update Shift Information</h2>

    <form method="post">
        <input type="hidden" name="Shift_ID" value="<?php echo htmlspecialchars($Shift_ID); ?>">

        <label for="Shift_Date">Shift Date:</label>
        <input type="date" name="Shift_Date" id="Shift_Date" value="<?php echo htmlspecialchars($Shift_Date); ?>" required><br><br>

        <label for="Start_Time">Start Time:</label>
        <input type="time" name="Start_Time" id="Start_Time" value="<?php echo htmlspecialchars($Start_Time); ?>" required><br><br>

        <label for="End_Time">End Time:</label>
        <input type="time" name="End_Time" id="End_Time" value="<?php echo htmlspecialchars($End_Time); ?>" required><br><br>

        <label for="Employee_ID">Employee ID:</label>
        <input type="number" name="Employee_ID" id="Employee_ID" value="<?php echo htmlspecialchars($Employee_ID); ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
</div>

</body>
</html>
