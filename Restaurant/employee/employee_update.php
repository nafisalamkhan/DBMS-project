<?php
include("../../admin/db.php");

$Employee_ID = "";
$name = "";
$address = "";
$phone = "";
$email = "";
$position = "";
$salary = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["Employee_ID"])) {
        echo "Employee ID is required not part of our project yet {under construction}";
        exit;
    }

    $Employee_ID = $_GET["Employee_ID"];

    $sql = "SELECT * FROM employee WHERE Employee_ID=$Employee_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
       echo "Employee ID is not found";
        exit;
    }

    $name = $row["Name"];
    $address = $row["Address"];
    $phone = $row["Phone"];
    $email = $row["Email"];
    $position = $row["Position"];
    $salary = $row["salary"];
    

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Employee_ID = $_POST["Employee_ID"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $position = $_POST["position"];
    $salary = $_POST["salary"];

    if (empty($Employee_ID) || empty($name) || empty($address) || empty($phone) || empty($email) || empty($position) || empty($salary)) {
        $errorMessage = "All fields are required!";
    }
    $sql = "UPDATE employee SET `Name` = '$name', 
                   `Address`='$address',
                   Phone='$phone',
                   Email = '$email',
                   Position = '$position',
                   salary= '$salary' 
               WHERE Employee_ID='$Employee_ID'";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    }
    $conn->close();
    header("location: ./employee_table.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Update</title>
    <link rel="stylesheet" href="employee_update.css">
</head>
<body>

<div class="container">
    <h2>Update Employee Information</h2>

    <form method="post">

        <input type="hidden" name="Employee_ID" value="<?php echo $Employee_ID; ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>">

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo $address; ?>">

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>">

        <label for="position">Position</label>
        <input type="text" name="position" id="position" value="<?php echo $position; ?>">

        <label for="salary">Salary:</label>
        <input type="text" name="salary" id="salary" value="<?php echo $salary; ?>">


        <input type="submit" value="Update">


    </form>
</div>



</body>
</html>