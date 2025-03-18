<?php
// Admin Dashboard
include 'db.php';
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Fetch all orders
$order_query = "SELECT o.id, u.name AS client_name, o.client_phone, o.street_name, o.house_number, o.address, 
                f.name AS food_name, f.price, o.quantity, o.status, o.created_at
                FROM orders o
                INNER JOIN clients u ON o.user_id = u.id
                INNER JOIN foods f ON o.food_id = f.id
                ORDER BY o.created_at DESC";
$result = $conn->query($order_query);

// Handle order status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    // Validate status update
    if (in_array($new_status, ['Pending', 'Processing', 'Completed', 'Cancelled'])) {
        $update_query = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', $new_status, $order_id);

        if ($stmt->execute()) {
            header('Location: admin_dashboard.php');
            exit;
        } else {
            $error = "Error updating status.";
        }
        $stmt->close();
    } else {
        $error = "Invalid status selected.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
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

.error {
    color: red;
    text-align: center;
    font-weight: bold;
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

.status-form select {
    padding: 5px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.status-form button {
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.status-form button:hover {
    background-color: #0056b3;
}

.orders-table tr:hover {
    background-color: #f1f1f1;
}

</style>
<body>
    <div class="header">
        <a href="index.php" class="logo">Home</a>
        <a href="admin_logout.php" class="btn btn-logout">Logout</a>
    </div>

    <div class="container">
        <h2>Admin Dashboard</h2>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Client Name</th>
                        <th>Phone</th>
                        <th>Street</th>
                        <th>House Number</th>
                        <th>Address</th>
                        <th>Food Item</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Date & Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['client_name']; ?></td>
                            <td><?php echo $order['client_phone']; ?></td>
                            <td><?php echo $order['street_name']; ?></td>
                            <td><?php echo $order['house_number']; ?></td>
                            <td><?php echo $order['address']; ?></td>
                            <td><?php echo $order['food_name']; ?></td>
                            <td><?php echo $order['quantity']; ?></td>
                            <td><?php echo ucfirst($order['status']); ?></td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($order['created_at'])); ?></td>
                            <td>
                                <form method="POST" action="" class="status-form">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <select name="status" required>
                                        <option value="">Select</option>
                                        <option value="Pending" <?php echo ($order['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="Processing" <?php echo ($order['status'] == 'Processing') ? 'selected' : ''; ?>>Processing</option>
                                        <option value="Completed" <?php echo ($order['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                        <option value="Cancelled" <?php echo ($order['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn btn-update">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No orders available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
