<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            margin: 20px;
            font-family: Arial, sans-serif;
        }
        .menu-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .food-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .food-item:hover {
            transform: translateY(-5px);
        }
        .food-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .food-item .card-body {
            padding: 15px;
            text-align: center;
        }
        .food-item h5 {
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        .food-item p {
            margin-bottom: 15px;
            color: #555;
            text-decoration: none;
        }
        .order-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color:rgb(58, 3, 29);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9rem;
        }
       .food-item1{
        background-image: url(./image/pizza.jpg);
        background-size: cover;
        text-align: center;
        color:black;
       }
       .food-item2{
        background-image: url(./image/burger.jpg);
        background-size: cover;
        text-align: center;
        color:black;
       }
       .food-item3{
        background-image: url(./image/pasta.jpg);
        background-size: cover;
        text-align: center;
        color:black;
       }
       .food-item4{
        background-image: url(./image/caesar\ salad.jpg);
        background-size: cover;
        text-align: center;
        color:white;
       }
       .food-item5{
        background-image: url(./image/garlic\ bread.jpg);
        background-size: cover;
        text-align: center;
        color:white;
       }
       .food-item6{
        background-image: url(./image/margherita\ pizza.jpg);
        background-size: cover;
        text-align: center;
        color:black;
       }
       .food-item7{
        background-image: url(./image/spagheti\ carbonara.jpg);
        background-size: cover;
        text-align: center;
        color:black;
       }
       .food-item8{
        background-image: url(./image/grilled\ salmon.jpg);
        background-size: cover;
        text-align: center;
        color:white;
       }
       .food-item9{
        background-image: url(./image/cheese\ cake.jpg);
        background-size: cover;
        text-align: center;
        color:black;
       }

       .bt{
        text-decoration-color: white;
        text-decoration: none;
        background-color: black;
       }
     
    </style>
</head>
<body>
  <div class="home"> 
<button><a href="index.php" class="bt">HOME</a></button>
</div> 
<h2 class="menu-title">Food Menu</h2>

<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="food-item1">
            
                <div class="card-body">
                    <h5>Pizza</h5>
                    <p>Price: Tsh. 10,000/=</p>
                    <a href="login.php" class="order-btn">Place Your Order</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="food-item2">
            
                <div class="card-body">
                    <h5>Burger</h5>
                    <p>Price:  Tsh. 9500/=</p>
                    <a href="login.php" class="order-btn">Place Your Order</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="food-item3">
                
                <div class="card-body">
                    <h5>Pasta</h5>
                    <p>Price:  Tsh. 6500/=</p>
                    <a href="login.php" class="order-btn">Place Your Order</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="food-item4">
                
                <div class="card-body">
                    <h5>Caesar Salad</h5>
                    <p>Price: Tsh. 2500/=</p>
                    <a href="login.php" class="order-btn">Place Your Order</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="food-item5">
        
                <div class="card-body">
                    <h5>Garlic Bread</h5>
                    <p>Price: Tsh. 4500/=</p>
                    <a href="login.php" class="order-btn">Place Your Order</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="food-item6">
                
                <div class="card-body">
                    <h5>Margherita Pizza</h5>
                    <p>Price:  Tsh. 8500/=</p>
                    <a href="login.php" class="order-btn">Place Your Order</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="food-item7">
                
                <div class="card-body">
                    <h5>Spaghetti Carbonara</h5>
                    <p>Price: Tsh. 3000/=</p>
                    <a href="login.php" class="order-btn">Place Your Order</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="food-item8">
                
                <div class="card-body">
                    <h5>Grilled Salmon</h5>
                    <p>Price: Tsh. 3500/=</p>
                    <a href="login.php" class="order-btn">Place Your Order</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="food-item9">
                
                <div class="card-body">
                    <h5>Cheesecake</h5>
                    <p>Price:  Tsh. 4500/=</p>
                    <a href="login.php" class="order-btn">Place Your Order</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-3">
    <p>&copy; 2024 Restaurant. All rights reserved.</p>
</footer>

</body>
</html>
