<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Dashboard</title>
    <link rel="stylesheet" href="r_dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="menu">
            <div class="option">
                <a href="http://localhost/dbdine/home/home.php">Home</a>
            </div>
            <div class="option">
                <a href="http://localhost/dbdine/Restaurant/orders/orders.php">Orders</a>
            </div>
            <div class="option">
                <a href="http://localhost/dbdine/Restaurant/menu/menu.php">Menu</a>
            </div>
            <div class="option">
                <a href="http://localhost/dbdine/Restaurant/inventory/inventory.php">Inventory</a>
            </div>
            <div class="option">
                <a href="http://localhost/dbdine/Restaurant/supplier/suppliers.php">Supplier</a>
            </div>
            <div class="option">
                <a href="http://localhost/dbdine/Restaurant/employee/employee_table.php">Employee</a>
            </div>
            <div class="option">
                <a href="http://localhost/dbdine/Restaurant/customer/customer_info.php">Customer</a>
            </div>
            <div class="option">
                <a href="http://localhost/dbdine/Restaurant/reservation/reservation.php">Reservation</a>
            </div>
            <div class="option">
                <a href="http://localhost/dbdine/Restaurant/reviews/reviews.php">Reviews</a>
            </div>
            <div class="option">
                <a href="http://localhost/dbdine/Restaurant/events/events.php">Events</a>
            </div>
        </div>
    </div>
    
<?php
include('../../admin/db.php'); 
?>

</body>
</html>

