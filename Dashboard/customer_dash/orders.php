<?php
session_start();

if (!isset($_SESSION['Customer_ID']) || $_SESSION['UserType'] != 'customer') {
    header("Location: ../../login/login.php");
    exit();
}

include ('../../admin/db.php');

$customer_id = $_SESSION['Customer_ID'];

$sql = "SELECT o.Order_ID, o.Quantity, DATE_FORMAT(o.order_date, '%Y-%m-%d %H:%i:%s') AS order_date, o.sub_total, o.Restaurant_ID, GROUP_CONCAT(m.Item_Name SEPARATOR ', ') AS food_items
        FROM orders o
        JOIN menu m ON o.Item_Number = m.Item_Number
        WHERE o.Customer_ID = ?
        GROUP BY o.Order_ID, o.Quantity, o.order_date, o.sub_total, o.Restaurant_ID";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = "<table><tr><th>Food Items</th><th>Quantity</th><th>Order Date</th><th>Sub Total</th><th>Review</th></tr>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders .= "<tr>
                    <td>{$row['food_items']}</td>
                    <td>{$row['Quantity']}</td>
                    <td>{$row['order_date']}</td>
                    <td>\${$row['sub_total']}</td>
                    <td>
                        <form action='submit_review.php' method='post'>
                            <input type='hidden' name='order_id' value='{$row['Order_ID']}'>
                            <input type='hidden' name='restaurant_id' value='{$row['Restaurant_ID']}'>
                            <label for='rating'>Rating:</label>
                            <select name='rating' required>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                            </select>
                            <label for='comments'>Comments:</label>
                            <textarea name='comments' required></textarea>
                            <button type='submit'>Submit Review</button>
                        </form>
                    </td>
                    </tr>";
    }
} else {
    $orders .= "<tr><td colspan='6'>No orders found</td></tr>";
}
$orders .= "</table>";

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_orders.css">
    <title>Previous Orders</title>
</head>

<body>
    <div class="orders-container">
        <h2>Your Previous Orders</h2>
        <?php echo $orders; ?>
        <a href="customer_home.php">Go back to Dashboard</a>
    </div>
</body>

</html>