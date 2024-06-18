<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <title>Restaurant Homepage</title>
</head>
<body>

<?php
session_start();
include('../admin/db.php');

if (!isset($_SESSION['Restaurant_ID'])) {
    header("Location: login.php");
    exit();
}

$restaurant_id = $_SESSION['Restaurant_ID'];
$query = $conn->prepare("SELECT Name, Address, Phone, Email, Cuisine_Type, Opening_Hour FROM restaurant WHERE Restaurant_ID=?");
$query->bind_param("i", $restaurant_id);
$query->execute();
$query->bind_result($name, $address, $phone, $email, $cuisine_type, $opening_hour);
$query->fetch();
$query->close();
?>


<nav class="w3-bar w3-black">
    <a href="http://localhost/dbdine/Restaurant/r_dashboard/r_dashboard.php" class="w3-button w3-bar-item">Dashboard</a>
    <a href="http://localhost/dbdine/home/edit.php" class="w3-button w3-bar-item">Edit Homepage</a>
</nav>


<div class="bg">
    <div class="content">
        <h1><?php echo htmlspecialchars($name); ?>
        <h5><p class="w3-opacity"><i>We serve the best <?php echo htmlspecialchars($cuisine_type); ?> cuisine.</i></p>
        </h5>
    </h1>
        </div>
</div>



<footer class="footer">
    <p>Address: <?php echo htmlspecialchars($address); ?></p>
    <p>Opening Hour: <?php echo htmlspecialchars($opening_hour); ?></p>
    <p>Phone: <?php echo htmlspecialchars($phone); ?></p>
    <p>Email: <?php echo htmlspecialchars($email); ?></p>
</footer>

</body>
</html>
