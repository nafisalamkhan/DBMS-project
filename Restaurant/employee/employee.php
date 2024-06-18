<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
    <link rel="stylesheet" href="employee.css">
</head>
<body>
    
    <form action="employee.php" method="post">
        <h2>Employee Registration Form</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="n" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required><br><br>

        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary" required><br><br>

        <input type="submit" value="Register">
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
        $name = isset($_POST['n']) ? $_POST['n'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $position = isset($_POST['position']) ? $_POST['position'] : '';
        $salary = isset($_POST['salary']) ? $_POST['salary'] : '';

        $check_query = "SELECT * FROM Employee WHERE Email=? AND Restaurant_ID=?";

        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("si", $email, $Restaurant_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Error: The email '$email' already exists. Please choose a different email.";
        } else {
            $sql = "INSERT INTO Employee (Name, Address, Phone, Email, Position, Salary, Restaurant_ID)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $name, $address, $phone, $email, $position, $salary, $Restaurant_ID);

            if ($stmt->execute() === TRUE) {
                header('Location: employee_table.php');
                exit();
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
