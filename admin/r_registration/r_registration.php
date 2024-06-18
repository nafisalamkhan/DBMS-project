<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Registration</title>
    <link rel="stylesheet" href="r_registration.css">
</head>
<body>
    
    <form action="r_registration.php" method="post">
    <h2>Restaurant Registration Form</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="cuisine_type">Cuisine Type:</label>
        <input type="text" id="cuisine_type" name="cuisine_type" required><br><br>

        <label for="opening_hour">Opening Hour:</label>
        <input type="text" id="opening_hour" name="opening_hour" required><br><br>

        <input type="submit" value="Register">
    </form>

    <?php
include('../db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $cuisine_type = isset($_POST['cuisine_type']) ? $_POST['cuisine_type'] : '';
    $opening_hour = isset($_POST['opening_hour']) ? $_POST['opening_hour'] : '';

      $check_query = "SELECT * FROM Restaurant WHERE Name='$n'";
      $result = $conn->query($check_query);
      if ($result->num_rows > 0) {
          echo "Error: The name '$n' already exists. Please choose a different name.";
      } else {
          $sql = "INSERT INTO Restaurant (Name, Address, Phone, Email, password, Cuisine_Type, Opening_Hour)
                  VALUES ('$n', '$address', '$phone', '$email', '$password', '$cuisine_type', '$opening_hour')";
  
          if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
}

$conn->close();
?>




</body>
</html>
