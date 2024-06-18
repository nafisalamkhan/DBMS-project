<?php
session_start();

if (!isset($_SESSION['Customer_ID']) || $_SESSION['UserType'] != 'customer') {
    header("Location: ../../login/login.php");
    exit();
}

include ('../../admin/db.php');

$orderConfirmed = false;
$selected_restaurant_id = null;
$menu_items = [];

$sql = "SELECT Restaurant_ID, Name FROM restaurant";
$result = $conn->query($sql);

$restaurants = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['restaurant_id']) && !isset($_POST['cart'])) {
        $selected_restaurant_id = $_POST['restaurant_id'];

        $stmt = $conn->prepare("SELECT Item_Number, Item_Name, price, Description FROM menu WHERE Restaurant_ID = ?");
        $stmt->bind_param("i", $selected_restaurant_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $menu_items[] = $row;
            }
        }
        $stmt->close();
    } elseif (isset($_POST['cart']) && isset($_POST['restaurant_id'])) {
        $customer_id = $_SESSION['Customer_ID'];
        $cart = json_decode($_POST['cart'], true);
        $selected_restaurant_id = $_POST['restaurant_id'];

        error_log("Customer ID: $customer_id");
        error_log("Restaurant ID: $selected_restaurant_id");
        error_log("Cart: " . json_encode($cart));

        if (is_array($cart)) {
            foreach ($cart as $item) {
                $item_number = $item['id'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                $subtotal = $quantity * $price;

                $stmt = $conn->prepare("INSERT INTO orders (Customer_ID, Item_Number, Quantity, sub_total, order_date, Restaurant_ID) VALUES (?, ?, ?, ?, NOW(), ?)");
                if (!$stmt) {
                    error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
                }
                $stmt->bind_param("iiiii", $customer_id, $item_number, $quantity, $subtotal, $selected_restaurant_id);
                if (!$stmt->execute()) {
                    error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
                }
                $stmt->close();
            }

            $orderConfirmed = true;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="styles_menu.css">
    <title>Menu</title>
</head>

<body>
    <div class="menu-cart-container">
        <div class="menu-container">
            <h2>Select Restaurant</h2>
            <form method="post" action="menu.php">
                <select name="restaurant_id" required onchange="this.form.submit()">
                    <option value="">Select a restaurant</option>
                    <?php foreach ($restaurants as $restaurant): ?>
                        <option value="<?php echo $restaurant['Restaurant_ID']; ?>" <?php if ($selected_restaurant_id == $restaurant['Restaurant_ID'])
                               echo 'selected'; ?>>
                            <?php echo $restaurant['Name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <?php if ($selected_restaurant_id): ?>
                <h2>Menu</h2>
                <table class="menu-table">
                    <tr>
                        <th>Food Item</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    <?php if (count($menu_items) > 0): ?>
                        <?php foreach ($menu_items as $item): ?>
                            <tr>
                                <td><?php echo $item['Item_Name']; ?></td>
                                <td>$<?php echo $item['price']; ?></td>
                                <td><?php echo $item['Description']; ?></td>
                                <td><input type='number' id='quantity-<?php echo $item['Item_Number']; ?>' value='1' min='1'
                                        class='quantity-input'></td>
                                <td><button type="button" class="add-to-cart"
                                        onclick="addToCart(<?php echo $item['Item_Number']; ?>, '<?php echo $item['Item_Name']; ?>', <?php echo $item['price']; ?>)">Add
                                        to Cart</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No menu items found for the selected restaurant.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            <?php endif; ?>
            <a href="customer_home.php" class="back-button">Go back to Dashboard</a>
        </div>

        <div class="cart">
            <h3>Food Cart</h3>
            <div id="cart-items"></div>
            <div class="cart-total">Total: $<span id="total-amount">0.00</span></div>
            <form id="order-form" method="POST">
                <input type="hidden" name="cart" id="cart-input">
                <input type="hidden" name="restaurant_id" value="<?php echo $selected_restaurant_id; ?>">
                <button type="button" onclick="placeOrder()" class="order-button">Order Now</button>
            </form>
        </div>
    </div>

    <?php if ($orderConfirmed): ?>
        <div class="order-confirmation">
            <p>Your order is confirmed!</p>
        </div>
    <?php endif; ?>

    <script>
        let cart = [];

        function addToCart(id, name, price) {
            const quantity = document.getElementById('quantity-' + id).value;
            const item = cart.find(i => i.id === id);
            if (item) {
                item.quantity += parseInt(quantity);
            } else {
                cart.push({ id, name, price, quantity: parseInt(quantity) });
            }
            console.log('Cart:', cart);  // Debugging line
            renderCart();
        }

        function removeFromCart(id) {
            cart = cart.filter(i => i.id !== id);
            renderCart();
        }

        function renderCart() {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            let totalAmount = 0;
            cart.forEach(item => {
                totalAmount += item.price * item.quantity;
                cartItems.innerHTML += `
                    <div class="cart-item">
                        <span>${item.name} (${item.quantity})</span>
                        <button type="button" onclick="removeFromCart(${item.id})">Remove</button>
                    </div>
                `;
            });
            document.getElementById('total-amount').innerText = totalAmount.toFixed(2);
            console.log('Total Amount:', totalAmount);  // Debugging line
        }

        function placeOrder() {
            if (cart.length === 0) {
                alert('Your cart is empty!');
                return;
            }

            const cartInput = document.getElementById('cart-input');
            cartInput.value = JSON.stringify(cart);
            console.log("Cart JSON:", cartInput.value);  // Debugging line
            document.getElementById('order-form').submit();
        }
    </script>
</body>

</html>