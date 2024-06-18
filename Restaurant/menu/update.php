<?php
include("../../admin/db.php");

$Item_Number = "";
$itemname = "";
$price = "";
$description = "";



if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["Item_Number"])) {
        echo "Item Number is required";
        exit;
    }

    $Item_Number = $_GET["Item_Number"];

    $sql = "SELECT * FROM menu WHERE Item_Number=$Item_Number";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
       echo "Item not found";
        exit;
    }

    $itemname = $row["Item_Name"];
    $price = $row["price"];
    $description = $row["Description"];
    
    

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Item_Number = $_POST["Item_Number"];
    $itemname = $_POST["itemname"];
    $price = $_POST["price"];
    $description = $_POST["description"];
   

    if (empty($Item_Number) || empty($itemname) || empty($price) || empty($description) ) {
        $errorMessage = "All fields are required!";
    }
    $sql = "UPDATE menu SET `Item_Name` = '$itemname', 
                   `price`='$price',
                   `Description`='$description'
             
               WHERE Item_Number='$Item_Number'";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    }
    $conn->close();
    header("location: ./menu.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>

<div class="container">
    <h2>Update Menu</h2>

    <form method="post">

    

        <input type="hidden" name="Item_Number" value="<?php echo $Item_Number; ?>">

        <label for="itemname">Item Name:</label>
        <input type="text" name="itemname" id="itemname" value="<?php echo $itemname; ?>">

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?php echo $price; ?>">

        <label for="description">Description:</label>
        <input type="text" name="description" id="description" value="<?php echo $description; ?>">


        <input type="submit" value="Update">


    </form>
</div>



</body>
</html>