<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shift</title>
    <link rel="stylesheet" href="shift_add.css">
</head>
<body>
    
    <form action="shift_add.php" method="post">
        <h2>Add shift</h2>
        <label for="date">Shift Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="stime">Start Time:</label>
        <input type="time" id="stime" name="stime" required><br><br>

        <label for="etime">End Time:</label>
        <input type="time" id="etime" name="etime" required><br><br>

        <label for="employee_id">Employee ID:</label>
        <input type="number" id="employee_id" name="employee_id" required><br><br>

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
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $stime = isset($_POST['stime']) ? $_POST['stime'] : '';
        $etime = isset($_POST['etime']) ? $_POST['etime'] : '';
        $employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';

        $sql = "SELECT * FROM Employee WHERE Employee_ID = ? AND Restaurant_ID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $employee_id, $Restaurant_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $insert_sql = "INSERT INTO shift (Shift_Date, Start_Time, End_Time, Employee_ID) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("sssi", $date, $stime, $etime, $employee_id);
            if ($insert_stmt->execute()) {
                header('Location: shift.php');
            } else {
                echo "Error: " . $insert_stmt->error;
            }
            $insert_stmt->close();
        } else {
            echo "Error: Employee does not exist.";
        }

        $stmt->close();
    }

    $conn->close();
    ?>

</body>
</html>
