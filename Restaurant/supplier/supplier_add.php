<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier</title>
    <link rel="stylesheet" href="supplier_add.css">
</head>
<body>
    
    <form action="supplier_add.php" method="post">
        <h2>Add Supplier</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

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
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $restaurant_id = $_SESSION['Restaurant_ID'];

        $check_query = "SELECT * FROM supplier WHERE `Email` ='$email'";
        $result = $conn->query($check_query);
        if ($result->num_rows > 0) {
            echo "Error: The Marchent having '$email' already exists.";
        } else {
            $stmt = $conn->prepare("INSERT INTO supplier (`Name`, `Address`, Phone, Email, Restaurant_ID)
                    VALUES (?,?,?,?,?)");

                 $stmt->bind_param("ssisi", $name, $address, $phone, $email, $restaurant_id);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

            
        }
        $stmt->close();
    }

    $conn->close();
    ?>

</body>
</html>
