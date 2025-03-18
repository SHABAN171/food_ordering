<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Ordering System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(../food_ordering/image/chicken-skewers-with-slices-sweet-peppers-dill.jpg);
            background-size: cover;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .hero-section {
            background-image: url(../food_ordering/image/chicken-skewers-with-slices-sweet-peppers-dill.jpg) no-repeat center center/cover;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 4rem;
        }
        .btn-order {
            background-color:rgb(8, 35, 69);
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-order:hover {
            background-color:rgb(148, 26, 12);
        }
        .section {
            padding: 60px 20px;
        }
.text{
color:white;
background-color:rgb(148, 14, 12);

}


    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Restaurant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_login.php"><b>Admin's Login</b></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-section" id="home">
        <div>
            <h1>Welcome to Our Restaurant</h1>
            <p>Your favorite meals delivered to your door</p>
            <a href="menu.php" class="btn btn-order">View Our Menu</a>
        </div>
    </div>
<div class="text">
    <div class="section" id="about">
        <div class="container">
            <h2 style="color:white" >About Us</h2>
            <p style="color:white">We are committed to serving you the best food with the highest quality ingredients. Our team works tirelessly to bring you a variety of cuisines to satisfy your cravings.</p>
        </div>
    </div>

    <div class=" " id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>If you have any questions or feedback, feel free to reach out to us:</p>
            <ul>
                <li>Email: support@restaurant.com</li>
                <li>Phone: +255 714 567 890</li>
                <li>Address: 123 Main Street, Food City</li>

            </ul>
            
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
