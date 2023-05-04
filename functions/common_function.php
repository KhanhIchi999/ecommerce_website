<?php 

    // including connect file
    include "./includes/connectDB.php";
    
    // getting products
    function getProducts() {

        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;


        // check if exist category or brand variable on url

        if(!isset($_GET['category']) && !isset($_GET['brand'])) {

            

            // select all data from the products table and the data will random 
            //becasuse i don't want user see the same result when user visit page and page will show 6 products
            $sql = "SELECT * FROM products order by rand() limit 0,6";
            $result = mysqli_query($conn, $sql);

            // check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {

                // output data of each row
                while($row_data = mysqli_fetch_assoc($result)) {

                    $product_id = $row_data["product_id"];
                    $product_name = $row_data["product_name"];
                    $product_description = $row_data["product_description"];
                    $product_price = $row_data["product_price"];
                    $product_image = $row_data["product_image"];
                    $category_id = $row_data["category_id"];
                    $brand_id = $row_data["brand_id"];

                    
                    echo '<div class="col-md-4">
                            <div class="card mb-4">
                                <img src="./admin_area/'.$product_image.'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . $product_name .'</h5>
                                    <p class="card-text">'. $product_description .'</p>
                                    <a href="#" class="btn btn-primary">Add to cart</a>
                                    <a href="#" class="btn btn-secondary">View more</a>
                                </div>
                            </div>
                        </div>';

                }
            } else {
                echo 'No products found';
            }
        }
    }

    // getting unique category
    function getUniqueCategory() {

        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;


        // check if exist category or brand variable on url

        if(isset($_GET['category'])) {

            $category_id = $_GET['category'];
            // select all data from the products table where category_id 
            $sql = "SELECT * FROM products WHERE category_id=$category_id";
            $result = mysqli_query($conn, $sql);

            // check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {

                // output data of each row
                while($row_data = mysqli_fetch_assoc($result)) {

                    $product_id = $row_data["product_id"];
                    $product_name = $row_data["product_name"];
                    $product_description = $row_data["product_description"];
                    $product_price = $row_data["product_price"];
                    $product_image = $row_data["product_image"];
                    $category_id = $row_data["category_id"];
                    $brand_id = $row_data["brand_id"];

                    
                    echo '<div class="col-md-4">
                            <div class="card mb-4">
                                <img src="./admin_area/'.$product_image.'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . $product_name .'</h5>
                                    <p class="card-text">'. $product_description .'</p>
                                    <a href="#" class="btn btn-primary">Add to cart</a>
                                    <a href="#" class="btn btn-secondary">View more</a>
                                </div>
                            </div>
                        </div>';

                }
            } else {
                echo '<h2 class="col-md-12 text-center text-danger">No products found</h2>';
            }
        }
    }

    // getting unique category
    function getUniqueBrand() {

        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;


        // check if exist category or brand variable on url

        if(isset($_GET['brand'])) {

            $brand_id = $_GET['brand'];
            // select all data from the products table where brand_id 
            $sql = "SELECT * FROM products WHERE brand_id=$brand_id";
            $result = mysqli_query($conn, $sql);

            // check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {

                // output data of each row
                while($row_data = mysqli_fetch_assoc($result)) {

                    $product_id = $row_data["product_id"];
                    $product_name = $row_data["product_name"];
                    $product_description = $row_data["product_description"];
                    $product_price = $row_data["product_price"];
                    $product_image = $row_data["product_image"];
                    $category_id = $row_data["category_id"];
                    $brand_id = $row_data["brand_id"];

                    
                    echo '<div class="col-md-4">
                            <div class="card mb-4">
                                <img src="./admin_area/'.$product_image.'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . $product_name .'</h5>
                                    <p class="card-text">'. $product_description .'</p>
                                    <a href="#" class="btn btn-primary">Add to cart</a>
                                    <a href="#" class="btn btn-secondary">View more</a>
                                </div>
                            </div>
                        </div>';

                }
            } else {
                echo '<h2 class="col-md-12 text-center text-danger">No products found</h2>';
            }
        }
    }


    // displaying brands in sidenave
    function getBrands() {

        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;

         // select all data from the brands table
         $sql = "SELECT * FROM brands";
         $result = mysqli_query($conn, $sql);

         // check if there are any rows returned
         if (mysqli_num_rows($result) > 0) {
             // output data of each row
             while($row_data = mysqli_fetch_assoc($result)) {

                 $brand_name = $row_data["brand_name"];
                 $brand_id = $row_data["brand_id"];

               echo '<li class="list-group-item text-center">
                     <a href="index.php?brand=' . $brand_id . '" class="text-dark d-block text-decoration-none">
                         <span class="d-block">' . $brand_name . '</span>
                     </a>
                 </li>';

             }
         } else {
             echo '<li class="list-group-item text-center">No brands found</li>';
         }
    }

    // displaying categories in sidenave
    function getCategories() {
        
        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;

        // select all data from the categories table
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($conn, $sql);

        // check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
             // output data of each row
             while($row_data = mysqli_fetch_assoc($result)) {

                $category_name = $row_data["category_name"];
                $category_id = $row_data["category_id"];

              echo '<li class="list-group-item text-center">
                    <a href="index.php?category=' . $category_id . '" class="text-dark d-block text-decoration-none">
                        <span class="d-block">' . $category_name . '</span>
                    </a>
                </li>';

            }
        } else {
            echo '<li class="list-group-item text-center">No categories found</li>';
        }

    }

?>