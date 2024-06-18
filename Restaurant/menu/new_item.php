<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Item</title>
    <link rel="stylesheet" href="new_item.css">
</head>
<body>
    
    <form action="new_item.php" method="post">
    <h2>Insert New Item</h2>
        <label for="itemname">Item Name:</label>
        <input type="text" id="itemname" name="itemname" required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br><br>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required><br><br>

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
    $itemname = isset($_POST['itemname']) ? $_POST['itemname'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    $sql = "INSERT INTO menu (Item_Name, price, `Description`, Restaurant_ID)
        VALUES ('$itemname', '$price', '$description', '$Restaurant_ID')";
  
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
