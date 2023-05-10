<?php
    // connect to database
     include 'includes/connectDB.php';
     include 'functions/common_function.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Detail</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <div class="container-fluid px-0">

        <!-- header navbar session -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="#"><img src="./images/logo-vilas.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display_all.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i
                                class="fa-solid fa-cart-shopping"></i><sup><?php cartItem()?></sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Price: <?php total_cart_price()?> $</a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php
            // calling cart funtion from funtions/common_function.php
            cart();
        ?>

        <!-- welcome user session -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome Guest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
            </ul>
        </nav>

        <!-- title page -->
        <div>
            <h3 class="text-center">Villas Store</h3>
            <p class="text-center">Sells for passion</p>

        </div>

        <!-- main page -->
        <div class="container">
            <form action="" method="POST" class="py-5 px-3">  
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Imgae</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Remove</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            showCartItem();
                            removeCartItem(); 
                        ?>
                    </tbody>
                </table>
            </form>
            <div>
                <!-- subtotal -->
                <h4 class="px-3">Subtotal: <strong class="text-info"><?php total_cart_price() ?>$</strong></h4>
                <a class="btn btn-primary" href="index.php" role="button">Continue Shopping</a>
                <a class="btn btn-primary" href="index.php" role="button">Check Out</a>
            </div>

            <?php
                if(isset($_POST['update_cart'])) {

                    $ip = getIPAddress();

                    foreach ($_POST as $name => $value) {
                        if (strpos($name, 'quantity_') === 0) {

                            $product_id = substr($name, strlen('quantity_'));
                            $quantity = $value;

                            // echo "product_id: $product_id";
                            // echo "quantity: $quantity";
                            
                            // update quantity
                            $sql = "UPDATE  cart_details SET quantity=$quantity WHERE ip_address='$ip' AND product_id='$product_id'";
                            $result = (mysqli_query($conn, $sql));

                            if (!$result) {
                                echo "Error updating quantity for product ID $product_id: " . mysqli_error($conn);
                            }
                    
                        }
                    }

                    // echo "Cart updated successfully";
                    echo "<script>window.location.href='cart.php';</script>";

                    // xem lại code nha, còn phần tính total price nữa
                }
            ?>
        </div>

        <!-- footer -->
        <?php
            
            include 'includes/footer.php';

        ?>


    </div>








    <?php
    // close connect to database
    mysqli_close($conn);
    ?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>