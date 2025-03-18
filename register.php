<?php
include 'db.php';

$error = ""; 
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Basic validations
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (!preg_match('/^\d{10}$/', $phone)) {
        $error = "Please enter a valid 10-digit phone number.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match. Please try again.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Check if the email already exists
        $checkEmailQuery = "SELECT * FROM clients WHERE email = ?";
        $stmt = $conn->prepare($checkEmailQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email already exists
            $error = "Email is already registered. Please log in or use a different email.";
        } else {
            // Insert new user into the database
            $insertQuery = "INSERT INTO clients (name, email, password, phone) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);

            // Check if the query was prepared successfully
            if (!$stmt) {
                $error = "Prepare failed: " . $conn->error;
            } else {
                $stmt->bind_param("ssss", $name, $email, $hashedPassword, $phone);

                if ($stmt->execute()) {
                    $success = "Registration successful! You can now <a href='login.php'>log in</a>.";
                } else {
                    $error = "Error: " . $stmt->error;
                }
            }
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: black;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
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
            margin-bottom: 10px;
        }

        .alert {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        p {
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <a href="index.php">HOME</a>
    </div>

    <!-- Main Container -->
    <div class="container">
        <h2>Register</h2>

        <!-- Display Error or Success Messages -->
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form method="POST" action="">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>

            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>

            <label for="phone" class="form-label">Phone No.</label>
            <input type="tel" class="form-control" id="phone" name="phone" pattern="\d{10}" maxlength="10" required>

            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>

            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>

            <button type="submit" name="register" class="btn">Register</button>
        </form>

        <p>If you have an account, <a href="login.php">Login here</a></p>
    </div>

</body>
</html>
