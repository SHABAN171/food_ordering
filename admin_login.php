<?php
// Admin Login Page with Default Credentials
include 'db.php';
session_start();  // Ensure session is started at the very beginning

// Default Admin Credentials
$default_username = "shaban";
$default_password = "shaban123";

$error = "";  // Initialize error message

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check default admin credentials
    if ($username === $default_username && $password === $default_password) {
        $_SESSION['admin_id'] = 1; // Set a session variable to simulate admin login
        header('Location: admin_dashboard.php');  // Redirect to admin dashboard
        exit;
    } else {
        $error = "Invalid username or password.";  // Set error message for invalid login
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .alert {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        
        <!-- Display error message if any -->
        <?php if ($error): ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <!-- Login Form -->
        <form method="POST" action="">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>

            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>

            <button type="submit" name="admin_login" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
