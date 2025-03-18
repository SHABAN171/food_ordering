<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Restaurant Ordering System</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      height: 100vh;
    }

    .sidebar {
      width: 250px;
      background-color:rgb(63, 18, 108);
      color: white;
      height: 100vh;
      display: flex;
      flex-direction: column;
      position: fixed;
      padding-top: 20px;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 15px 20px;
      display: block;
      border-radius: 4px;
    }

    .sidebar a:hover {
      background-color: #34495e;
    }

    .sidebar a.active {
      background-color: #1abc9c;
    }

    .main-content {
      margin-left: 250px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .header {
      background-color: #ecf0f1;
      padding: 10px 20px;
      border-bottom: 1px solid #bdc3c7;
    }

    .content {
      margin-top: 20px;
      flex: 1;
      padding: 20px;
    }

    footer {
      background-color: #ecf0f1;
      text-align: center;
      padding: 10px;
      border-top: 1px solid #bdc3c7;
    }

    .container {
      max-width: 1200px;
      margin: auto;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
    }

    .col-md-4, .col-md-8 {
      padding: 10px;
    }

    .col-md-4 {
      flex: 0 0 33.3333%;
      max-width: 33.3333%;
    }

    .col-md-8 {
      flex: 0 0 66.6666%;
      max-width: 66.6666%;
    }

    .sidebar h3, .sidebar p {
      margin-left: 20px;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h3>Restaurant Ordering System</h3>
    <a href="index.php" class="active">Home</a>
    <a href="customer_profile.php">Profile</a>
    <a href="place_order.php">Place your Order</a>
    <a href="my_orders.php">My Orders</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="main-content">
    <div class="header">
      <h1>Welcome to the Dashboard</h1>
    </div>
    <section class="content">
      <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Here you can:</p>
        <ul>
          <li>Manage your profile settings.</li>
          <li>Place new orders.</li>
          <li>View and track your existing orders.</li>
          <li>Logout securely when you're done.</li>
        </ul>
      </div>
    </section>
    <footer>
      <p>&copy; <?php echo date("Y"); ?> Restaurant Ordering System. All rights reserved.</p>
    </footer>
  </div>
</body>
</html>
