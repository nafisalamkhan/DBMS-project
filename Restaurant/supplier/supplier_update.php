<?php
include("../../admin/db.php");

$Marchent_ID = "";
$Name = "";
$Address = "";
$Phone = "";
$Email = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["Marchent_ID"])) {
        echo "Item Number is required";
        exit;
    }

    $Marchent_ID = $_GET["Marchent_ID"];

    $sql = "SELECT * FROM supplier WHERE Marchent_ID=$Marchent_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
       echo "Item not found";
        exit;
    }

    $Name = $row["Name"];
    $Address = $row["Address"];
    $Phone = $row["Phone"];
    $Email = $row["Email"];
    
    

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Marchent_ID = $_POST["Marchent_ID"];
    $Name = $_POST["Name"];
    $Address = $_POST["Address"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];

    if (empty($Marchent_ID) || empty($Name) || empty($Address) || empty($Phone) || empty($Email) ) {
        $errorMessage = "All fields are required!";
    }
    $sql = "UPDATE supplier SET `Name` = '$Name', 
                   `Address`='$Address',
                   `Phone`='$Phone',
                   `Email`='$Email'
             
               WHERE Marchent_ID='$Marchent_ID'";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    }
    $conn->close();
    header("location: ./suppliers.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supplier</title>
    <link rel="stylesheet" href="supplier_update.css">
</head>
<body>

<div class="container">
    <h2>Update Supplier</h2>

    <form method="post">

        <input type="hidden" name="Marchent_ID" value="<?php echo $Marchent_ID; ?>">

        <label for="Name">Name:</label>
        <input type="text" name="Name" id="Name" value="<?php echo $Name; ?>">

        <label for="Address">Address:</label>
        <input type="text" name="Address" id="Address" value="<?php echo $Address; ?>">

        <label for="Phone">Phone:</label>
        <input type="text" name="Phone" id="Phone" value="<?php echo $Phone; ?>">

        <label for="Email">Email:</label>
        <input type="text" name="Email" id="Email" value="<?php echo $Email; ?>">


        <input type="submit" value="Update">


    </form>
</div>



</body>
</html>