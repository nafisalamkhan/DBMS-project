<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Add</title>
    <link rel="stylesheet" href="in_add.css">
</head>
<body>
    
    <form action="in_add.php" method="post">
        <h2>Inventory Add</h2>
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <label for="date">Expiration Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <input type="submit" value="Add">
    </form>

    <?php
session_start();
include("../../admin/db.php");

if (!isset($_SESSION['Restaurant_ID'])) {
    header("Location: ../../login/login.php");
    exit();
}

$Restaurant_ID = $_SESSION['Restaurant_ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $restaurant_id = $_SESSION['Restaurant_ID']; 

    $stmt = $conn->prepare("INSERT INTO inventory (Product_Name, Catagory, Quantity, Expiration_Date, Restaurant_ID) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("ssisi", $name, $category, $quantity, $date, $restaurant_id);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


</body>
</html>
