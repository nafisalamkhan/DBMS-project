<?php
include("../../admin/db.php");

$Product_ID = "";
$Product_Name = "";
$Catagory = "";
$Quantity = "";
$Expiration_Date = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["Product_ID"])) {
        echo "Product ID is required";
        exit;
    }

    $Product_ID = $_GET["Product_ID"];

    $sql = "SELECT * FROM inventory WHERE Product_ID=$Product_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
       echo "Item not found";
        exit;
    }

    $Product_Name = $row["Product_Name"];
    $Catagory = $row["Catagory"];
    $Quantity = $row["Quantity"];
    $Expiration_Date = $row["Expiration_Date"];
    
    

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Product_ID = $_POST["Product_ID"];
    $Product_Name = $_POST["Product_Name"];
    $Catagory = $_POST["Catagory"];
    $Quantity = $_POST["Quantity"];
    $Expiration_Date = $_POST["Expiration_Date"];
   
    if (empty($Product_ID) || empty($Product_Name) || empty($Catagory) || empty($Quantity) || empty($Expiration_Date) ) {
        $errorMessage = "All fields are required!";
    }
    $sql = "UPDATE inventory SET `Product_Name` = '$Product_Name', 
                   `Catagory`='$Catagory',
                   `Quantity`='$Quantity',
                   `Expiration_Date`='$Expiration_Date'
             
               WHERE Product_ID='$Product_ID'";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query : " . $conn->error);
    }
    $conn->close();
    header("location: ./inventory.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
    <link rel="stylesheet" href="inventory_update.css">
</head>
<body>

<div class="container">
    <h2>Update Inventory</h2>

    <form method="post">

  
        <input type="hidden" name="Product_ID" value="<?php echo $Product_ID; ?>">

        <label for="Product_Name">Product Name:</label>
        <input type="text" name="Product_Name" id="Product_Name" value="<?php echo $Product_Name; ?>">

        <label for="Catagory">Catagory:</label>
        <input type="text" name="Catagory" id="Catagory" value="<?php echo $Catagory; ?>">

        <label for="Quantity">Quantity:</label>
        <input type="number" name="Quantity" id="Quantity" value="<?php echo $Quantity; ?>">

        <label for="Expiration_Date">Expiration Date:</label>
        <input type="date" name="Expiration_Date" id="Expiration_Date" value="<?php echo $Expiration_Date; ?>">


        <input type="submit" value="Update">


    </form>
</div>



</body>
</html>