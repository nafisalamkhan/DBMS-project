<?php
session_start();

if (!isset($_SESSION['Customer_ID']) || $_SESSION['UserType'] != 'customer') {
    header("Location: ../../login/login.php");
    exit();
}

include ('../../admin/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $customer_id = $_SESSION['Customer_ID'];
    $restaurant_id = $_POST['restaurant_id'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    $stmt = $conn->prepare("INSERT INTO review (Order_ID, Customer_ID, Restaurant_ID, Rating, Comments, Review_Date) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiiss", $order_id, $customer_id, $restaurant_id, $rating, $comments);

    if ($stmt->execute()) {
        header("Location: orders.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>