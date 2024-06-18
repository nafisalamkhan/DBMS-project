<?php
session_start();

if (!isset($_SESSION['Customer_ID']) || $_SESSION['UserType'] != 'customer') {
    header("Location: ../../login/login.php");
    exit();
}

include ('../../admin/db.php');

$customer_id = $_SESSION['Customer_ID'];

$sql = "SELECT r.Rating, r.Comments, DATE_FORMAT(r.Review_Date, '%Y-%m-%d %H:%i:%s') AS Review_Date, 
               c.`First Name` AS Customer_First_Name, c.`Last Name` AS Customer_Last_Name, res.Name AS Restaurant_Name
        FROM review r
        JOIN customer c ON r.Customer_ID = c.Customer_ID
        JOIN restaurant res ON r.Restaurant_ID = res.Restaurant_ID
        WHERE r.Customer_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$reviews = "<table><tr><th>Rating</th><th>Comments</th><th>Review Date</th><th>Customer</th><th>Restaurant</th></tr>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews .= "<tr>
                    <td>{$row['Rating']}</td>
                    <td>{$row['Comments']}</td>
                    <td>{$row['Review_Date']}</td>
                    <td>{$row['Customer_First_Name']} {$row['Customer_Last_Name']}</td>
                    <td>{$row['Restaurant_Name']}</td>
                    </tr>";
    }
} else {
    $reviews .= "<tr><td colspan='5'>No reviews found</td></tr>";
}
$reviews .= "</table>";

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_reviews.css">
    <title>Customer Reviews</title>
</head>

<body>
    <div class="reviews-container">
        <h2>Your Reviews</h2>
        <?php echo $reviews; ?>
        <a href="customer_home.php">Go back to Dashboard</a>
    </div>
</body>

</html>