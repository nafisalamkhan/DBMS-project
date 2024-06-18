<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="registration_s.css">
</head>

<body>

<form method="post">
    <h2>Customer Registration Form</h2>
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required>

    <label for="userName">Username:</label>
    <input type="text" id="userName" name="userName" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" required>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="">Select</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <label for="restaurantId">Restaurant ID:</label>
    <input type="number" id="restaurantId" name="restaurantId" required>

    <input type="submit" value="Submit">
</form>

<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $userName = $_POST["userName"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $restaurantId = $_POST["restaurantId"];

    $check_query = "SELECT * FROM customer WHERE `user name`=?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: The username '$userName' already exists. Please choose a different username.";
    } else {
        $insert_query = "INSERT INTO customer (`First Name`, `Last Name`, `user name`, `password`, `Phone`, `Email`, `Address`, `Gender`, `Restaurant_ID`) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssssssssi", $firstName, $lastName, $userName, $password, $phone, $email, $address, $gender, $restaurantId);

        if ($stmt->execute()) {
            echo "Customer created successfully";
        } else {
            echo "Failed to create customer: " . $stmt->error;
        }
    }
}

$conn->close();
?>


</body>
</html>

