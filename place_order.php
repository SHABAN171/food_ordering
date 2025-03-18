<?php
include 'db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle order submission
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];
    $client_phone = trim($_POST['client_phone']);
    $street_name = trim($_POST['street_name']);
    $house_number = trim($_POST['house_number']);
    $address = trim($_POST['address']);

    // Validate inputs
    if (empty($food_id) || empty($quantity) || $quantity <= 0) {
        $error = "Invalid input. Please select a food item and enter a valid quantity.";
    } elseif (!preg_match('/^\d{10}$/', $client_phone)) {
        $error = "Please enter a valid 10-digit phone number.";
    } elseif (empty($street_name) || empty($house_number) || empty($address)) {
        $error = "Please fill in all address details.";
    } else {
        // Insert order into database
        $order_query = "INSERT INTO orders (user_id, food_id, quantity, client_phone, street_name, house_number, address, status) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')";
        $stmt = $conn->prepare($order_query);
        $stmt->bind_param('iiissss', $user_id, $food_id, $quantity, $client_phone, $street_name, $house_number, $address);

        if ($stmt->execute()) {
            $success = "Order placed successfully!";
        } else {
            $error = "Error placing order: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Fetch available foods
$food_query = "SELECT * FROM foods";
$foods_result = $conn->query($food_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #343a40;
            padding: 15px;
            text-align: center;
        }
        .header a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            padding: 10px;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        .form-label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="index.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="my_orders.php">My orders</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h2>Place Your Order</h2>

        <!-- Display Messages -->
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <!-- Order Form -->
        <form method="POST" action="">
            <label for="food_id" class="form-label">Select Food</label>
            <select class="form-control" id="food_id" name="food_id" required>
                <option value="">-- Select Food --</option>
                <?php while ($food = $foods_result->fetch_assoc()): ?>
                    <option value="<?php echo $food['id']; ?>">
                        <?php echo $food['name'] . " - Tsh " . $food['price']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>

            <label for="client_phone" class="form-label">Client Phone</label>
            <input type="tel" class="form-control" id="client_phone" name="client_phone" pattern="\d{10}" maxlength="10" required>

            <label for="street_name" class="form-label">Street Name</label>
            <input type="text" class="form-control" id="street_name" name="street_name" required>

            <label for="house_number" class="form-label">House Number</label>
            <input type="text" class="form-control" id="house_number" name="house_number" required>

            <label for="address" class="form-label">Full Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>

            <button type="submit" name="place_order" class="btn">Place Order</button>
        </form>
    </div>
</body>
</html>
