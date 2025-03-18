<?php
include 'db.php';
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user orders
$order_query = "SELECT o.id, f.name AS food_name, o.quantity, o.status, o.created_at
                FROM orders o
                INNER JOIN foods f ON o.food_id = f.id
                WHERE o.user_id = ?
                ORDER BY o.created_at DESC";
$stmt = $conn->prepare($order_query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .logo {
            font-size: 18px;
            text-decoration: none;
            color: white;
        }

        .header .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
        }

        .header .btn-logout {
            background-color: #f44336;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .orders-table th,
        .orders-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .orders-table th {
            background-color: #4CAF50;
            color: white;
        }

        .orders-table tr:hover {
            background-color: #f1f1f1;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="index.php" class="logo">Home</a>
        <a href="dashboard.php" class="logo">Dashboard</a>
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>

    <div class="container">
        <h2>My Orders</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Food Item</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['food_name']; ?></td>
                            <td><?php echo $order['quantity']; ?></td>
                            <td><?php echo ucfirst($order['status']); ?></td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($order['created_at'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have no orders.</p>
        <?php endif; ?>
    </div>
</body>
</html>
