<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="container-fluid px-0">
        <!-- hedear navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="#"><img src="../images/logo-vilas.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome guest</a>
                    </li>
                </ul>

            </div>
        </nav>

        <!-- title page -->
        <div class="bg-light">
            <h3 class="text-center py-3">Magage Details</h3>
        </div>

        <!-- option menu -->
        <!-- option menu -->
        <div class="bg-light">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="../images/ao1.webp" alt="Logo" width="50" height="50"
                            class="d-inline-block align-middle mr-2">
                        My Brand
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="insert_product.php">Insert Products</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="#">View Products</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="index.php?insert_category">Insert Categories</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="#">View Categories</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="index.php?insert_brand">Insert Brands</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="#">View Brands</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="#">All Orders</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="#">All Payments</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="#">List Users</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link custom-btn" href="#">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>


        <div class="container my-5 ">
            <?php
                if(isset($_GET['insert_category'])) {
                    include('insert_category.php');
                }
                if(isset($_GET['insert_brand'])) {
                    include('insert_brand.php');
                } 
            ?>
        </div>



    </div>


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