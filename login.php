<?php
include 'db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    session_start();

    // Sanitize and validate inputs
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);  

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Sanitize email input to prevent SQL injection
        $email = mysqli_real_escape_string($conn, $email);

        // Query to fetch the user details
        $sql = "SELECT * FROM clients WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the hashed password
            if (password_verify($password, $user['password'])) {
                // Start session and set session variables
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['loggedin'] = true;
            
                // Redirect to the dashboard
                header('Location: dashboard.php');
                exit;
            }
            
            } else {
                $error = "Invalid email or password.";
            }
     
            $error = "No user found with this email.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 0;
        }
        .home {
            background-color: black;
            height: 25px;
            padding-top: 5px;
        }
        .bt {
            color: white;
            text-decoration: none;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .mb-3 {
            margin-bottom: 15px;
        }
        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="home">
    <a href="index.php" class="bt">HOME</a>
</div>

<div class="container mt-5">
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"> <?php echo $error; ?> </div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button><br><br>
        <p>If you don't have an account, <a href="register.php">Register here</a></p>
    </form>
</div>

</body>
</html>
