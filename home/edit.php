<?php
session_start();
include("../admin/db.php");

if (!isset($_SESSION['Restaurant_ID'])) {
    header("Location: ../../login/login.php");
    exit();
}

$Restaurant_ID = $_SESSION['Restaurant_ID'];

$Name = "";
$Address = "";
$Phone = "";
$Email = "";
$Cuisine_Type = "";
$Opening_Hour = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    
    $sql = "SELECT * FROM restaurant WHERE Restaurant_ID=$Restaurant_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Restaurant ID is not found";
        exit;
    }

    $Name = $row["Name"];
    $Address = $row["Address"];
    $Phone = $row["Phone"];
    $Email = $row["Email"];
    $Cuisine_Type = $row["Cuisine_Type"];
    $Opening_Hour = $row["Opening_Hour"];

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST["Name"];
    $Address = $_POST["Address"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    $Cuisine_Type = $_POST["Cuisine_Type"];
    $Opening_Hour = $_POST["Opening_Hour"];


    $sql = "UPDATE restaurant SET 
                `Name` = '$Name', 
                `Address`='$Address',
                Phone='$Phone',
                Email = '$Email',
                Cuisine_Type = '$Cuisine_Type',
                Opening_Hour= '$Opening_Hour' 
            WHERE Restaurant_ID='$Restaurant_ID'";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query: " . $conn->error);
    }


    header("Location: ./home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Update</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>

<div class="container">
    <h2>Update Homepage</h2>
    
    <form method="post">
        <label for="Name">Name:</label>
        <input type="text" name="Name" id="Name" value="<?php echo $Name; ?>">

        <label for="Address">Address:</label>
        <input type="text" name="Address" id="Address" value="<?php echo $Address; ?>">

        <label for="Phone">Phone:</label>
        <input type="text" name="Phone" id="Phone" value="<?php echo $Phone; ?>">

        <label for="Email">Email:</label>
        <input type="email" name="Email" id="Email" value="<?php echo $Email; ?>">

        <label for="Cuisine_Type">Cuisine Type:</label>
        <input type="text" name="Cuisine_Type" id="Cuisine_Type" value="<?php echo $Cuisine_Type; ?>">

        <label for="Opening_Hour">Opening Hour:</label>
        <input type="text" name="Opening_Hour" id="Opening_Hour" value="<?php echo $Opening_Hour    ; ?>">

        <input type="submit" value="Update">
    </form>
</div>

</body>
</html>
