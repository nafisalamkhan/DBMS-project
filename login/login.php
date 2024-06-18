<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">
    <form action="login.php" method="post">
      <div class="row">
        <h2 style="text-align:center">Welcome to Database Dine!</h2>
        <div class="col">
          <input type="text" name="username" placeholder="Username" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="submit" value="Login">
          <h5 style="text-align:center">
            <p>Don't have an account yet? Sign up as
              <a href="../admin/r_registration/r_registration.php">Restaurant</a> or
              <a href="../admin/registration/registration.php">Customer</a>
            </p>
          </h5>
        </div>
      </div>
    </form>
  </div>

  <?php
  session_start();
  include ('../admin/db.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt1 = $conn->prepare("SELECT * FROM restaurant WHERE Name=? AND password=?");
    $stmt1->bind_param("ss", $username, $password);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    $stmt2 = $conn->prepare("SELECT * FROM customer WHERE `user name`=? AND password=?");
    $stmt2->bind_param("ss", $username, $password);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result1->num_rows == 1) {
      $row1 = $result1->fetch_assoc();
      $_SESSION['Restaurant_ID'] = $row1['Restaurant_ID'];
      $_SESSION['UserType'] = 'restaurant';
      header("Location: ../Restaurant/r_dashboard/r_dashboard.php");
      exit();
    } else if ($result2->num_rows == 1) {
      $row2 = $result2->fetch_assoc();
      $_SESSION['Customer_ID'] = $row2['Customer_ID'];
      $_SESSION['UserType'] = 'customer';
      header("Location: ../Dashboard/customer_dash/customer_home.php");
      exit();
    } else {
      echo "<p style='color:red;text-align:center;'>Invalid username or password. Please try again.</p>";
    }
  }
  $conn->close();
  ?>
</body>
</html>
