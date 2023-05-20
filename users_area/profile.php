<?php
    // connect to database
     include_once '../includes/connectDB.php';
     include_once '../functions/common_function.php';

     session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username']?></title>

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
                        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../display_all.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <?php
                            if(isset($_SESSION['username'])) {
                                echo "<a class='nav-link' href='profile.php'>My profile</a>";
                            } else {
                                echo "<a class='nav-link' href='user_registration.php'>Register</a>";
                            }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cartItem()?></sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Price: <?php total_cart_price()?> $</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="GET" action="../search_product.php">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='search_data'>
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                </form>
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
                    <?php
                        if(!isset($_SESSION['username'])) {
                            echo "<a class='nav-link' href=''>Welcome Guest</a>";
                        } else {
                            echo "<a class='nav-link' href=''>Welcome {$_SESSION['username']}</a>";
                        }
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                        if(!isset($_SESSION['username'])) {
                            echo "<a class='nav-link' href='user_login.php'>Log in</a>";
                        }else {
                            echo "<a class='nav-link' href='user_logout.php'>Log out</a>";
                        }
                    ?>
                </li>
            </ul>
        </nav>

        <!-- title page -->
        <div>
            <h3 class="text-center">Villas Store</h3>
            <p class="text-center">Sells for passion</p>

        </div>
        <!-- main page -->
        <div class="row py-5 px-3">
            <div class="col-md-2 text-center">
                <h4>Your Profile</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <?php
                            if(isset($_SESSION['username'])) {
                                $user_name = $_SESSION['username'];
                                $sql = "SELECT * FROM user_table WHERE user_name = '$user_name'";
                                $result_image = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result_image);
                                $user_image = $row['user_image'];
                                echo "<img src=$user_image alt='' class='img-thumbnail'>";
                            }
                        ?>
                    </li>
                    <li class="list-group-item">
                        <a href="profile.php">Pending order</a>
                    </li>
                    <li class="list-group-item">
                        <a href="profile.php?edit_account">Edit Account</a>
                    </li>
                    <li class="list-group-item">
                        <a href="profile.php?my_orders">My Orders</a>
                    </li>
                    <li class="list-group-item">
                        <a href="profile.php?delete_account">Delete Account</a>
                    </li>
                    <li class="list-group-item">
                        <a href="user_logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
               <?php
                    if(isset($_SESSION['username'])){
                        get_user_order_details();
                        if(isset($_GET['edit_account'])) {
                            include_once('edit_account.php');
                        }
                        else if(isset($_GET['my_orders'])) {
                            include_once('user_orders.php');
                        }
                        else if(isset($_GET['delete_account'])) {
                            include_once('delete_account.php');
                        }

                    }
               ?>
            </div>
        </div>


        <!-- footer -->
        <?php
            
            include '../includes/footer.php';

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