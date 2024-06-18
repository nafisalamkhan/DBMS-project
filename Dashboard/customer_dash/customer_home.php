<?php
session_start();

// Check if the user is logged in as a customer
if (!isset($_SESSION['Customer_ID']) || $_SESSION['UserType'] != 'customer') {
    header("Location: ../../login/login.php");
    exit();
}

// Include database connection
include('../../admin/db.php');

// Fetch customer details if needed
$customer_id = $_SESSION['Customer_ID'];
$stmt = $conn->prepare("SELECT `First Name`, `Last Name` FROM customer WHERE Customer_ID=?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer_home.css">
    <title>Customer Dashboard</title>
</head>
<body>
    <div class="navbar">
        <h1>Welcome, <?php echo htmlspecialchars($customer['First Name']); ?>!</h1>
        <nav>
            <a href="contact.php">Contact Us</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
    <div class="midsection">
        <div class="tab">
            <a href="menu.php">Menu</a>
        </div>
        <div class="tab">
            <a href="orders.php">Previous Orders</a>
        </div>
        <div class="tab">
            <a href="review.php">Leave a Review</a>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 Dine Customer. All rights reserved.</p>
    </div>
</body>
</html>
