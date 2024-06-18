<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Add</title>
    <link rel="stylesheet" href="reservation_add.css">
</head>
<body>
    
    <form action="reservation_add.php" method="post">
        <h2>Add Reservation</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="totalguests">Total Guests:</label>
        <input type="number" id="totalguests" name="totalguests" required><br><br>

        <label for="date">Reservation Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <input type="submit" value="Add">
    </form>

    <?php
   session_start();
   include('../../admin/db.php'); 
   
   if (!isset($_SESSION['Restaurant_ID'])) {
       header("Location: ../../login/login.php");
       exit();
   }
   
   $Restaurant_ID = $_SESSION['Restaurant_ID'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $totalguests = isset($_POST['totalguests']) ? $_POST['totalguests'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';

        
            $sql = "INSERT INTO reservation (`Name`, Total_Guests, Reservation_Date, Restaurant_ID)
                    VALUES ('$name', '$totalguests', '$date', '$Restaurant_ID')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    
    $conn->close();
    ?>

</body>
</html>
