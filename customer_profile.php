<?php
session_start();

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php'; // Include the database connection
$user_id = $_SESSION['user_id'];

// Fetch user details
$sql_user = "SELECT * FROM clients WHERE id = '$user_id'";
$result_user = $conn->query($sql_user);

if ($result_user) {
    $user = $result_user->fetch_assoc();
} else {
    die("Error fetching user data: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Restaurant Ordering System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color:rgb(18, 48, 44);
        }
        .profile-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #2c3e50;
        }
        p {
            margin: 10px 0;
            color: #34495e;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Profile</h1>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Phone No:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Registration Date:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
        <a href="dashboard.php" style="text-decoration: none; color: #1abc9c;">Back to Dashboard</a>
    </div>
</body>
</html>
