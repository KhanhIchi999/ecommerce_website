<?php 

    // including connect file
    include_once __DIR__ . "/../includes/connectDB.php";
    
    // getting products
    function getProducts($product_number) {

        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;


        // check if exist category or brand variable on url

        if(!isset($_GET['category']) && !isset($_GET['brand'])) {

            

            // select all data from the products table and the data will random 
            //becasuse i don't want user see the same result when user visit page and page will show  $product_number products
            $sql = "SELECT * FROM products order by rand() limit 0, $product_number";
            if(strtolower($product_number) == 'all') {
                $sql = "SELECT * FROM products order by rand()";
            }
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
                                    <p class="card-text">Price: '. $product_price .'</p>
                                    <a href="index.php?add_to_cart=' . $product_id . '" class="btn btn-primary">Add to cart</a>
                                    <a href="product_details.php?product_id=' . $product_id . '" class="btn btn-secondary">View more</a>
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
                                    <a href="index.php?add_to_cart=' . $product_id . '" class="btn btn-primary">Add to cart</a>
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
                                    <a href="index.php?add_to_cart=' . $product_id . '" class="btn btn-primary">Add to cart</a>
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

    // searching product
    function searchProduct($searchValue) {

        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;

        // select all data from the products table
        $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchValue%'";
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
                                <p class="card-text">Price: '. $product_price .'</p>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                                <a href="product_details.php?product_id=' . $product_id . '" class="btn btn-secondary">View more</a>
                            </div>
                        </div>
                    </div>';

            }
        } else {
            echo 'No products found';
        }

       
    }

    // view detail product

    function viewDetailProduct() {
        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;


        // check if exist category or brand variable on url

        if(isset($_GET['category'])) {

            $product_id = $_GET['product_id'];
            // select all data from the products table where product_id 
            $sql = "SELECT * FROM products WHERE product_id=$product_id";
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
                }
            }
        }
    }

    function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
        //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
        return $ip;  
    } 

    // cart function
    function cart() {

        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;

        if(isset($_GET['add_to_cart'])) {
            $ip = getIPAddress();  
            $get_product_id = $_GET['add_to_cart'];

            // select all data from the products table where category_id 
            $sql = "SELECT * FROM cart_details WHERE ip_address='$ip' AND product_id=$get_product_id";
            $result = mysqli_query($conn, $sql);

            if($result === false) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }else {
                
                // check if there are any rows returned
                if (mysqli_num_rows($result) > 0) {
    
                    echo "<script>alert('This item is already present inside cart')</script>";
                    echo "<script>window.open('index.php', '_self')</script>";
                } else {
                    // Insert new brand into database
                    $sql = "INSERT INTO cart_details (ip_address, product_id, quantity) VALUES ('$ip', '$get_product_id', '0')";
                    $result = (mysqli_query($conn, $sql));
            
                    if ($result) {
                        echo "<script>alert('Item is added to cart')</script>";
                        echo "<script>window.open('index.php', '_self')</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }



        }
    }

    // cart function
    function cartItem() {

        //use global to get $conn variable connect from ./includes/connectDB.php
        global $conn;

        $ip = getIPAddress();  

        // select all data from the products table where category_id 
        $sql = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $result = mysqli_query($conn, $sql);
        $count_cart_items = mysqli_num_rows($result);

        echo $count_cart_items;
    }

    // total price funtion
    function total_cart_price() {

        global $conn;

        $ip = getIPAddress();
        $total = 0;  

        // select all data from the products table where category_id 
        $sql = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $result = mysqli_query($conn, $sql);
        
        // iterate over the rows and calculate the total price
        while ($row = mysqli_fetch_assoc($result)) {

            $product_id = $row["product_id"];
            $quantity = $row["quantity"];

            $select_product = "SELECT * FROM products WHERE product_id='$product_id'";
            $result_product = mysqli_query($conn, $select_product);
            $product = mysqli_fetch_assoc($result_product);

            $price = $product["product_price"];
            $total += $price * $quantity;
        }

        echo $total;

    }

    function showCartItem() {

        global $conn;

        $ip = getIPAddress();
        $total = 0;  

        // select all data from the products table where ip_address 
        $sql = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $result = mysqli_query($conn, $sql);

        $result_count = mysqli_num_rows(($result));
        if($result_count > 0) {
            // iterate over the rows and calculate the total price
            while ($row = mysqli_fetch_assoc($result)) {
    
                
                $product_id = $row["product_id"];
                $quantity = $row["quantity"];
                
                $select_product = "SELECT * FROM products WHERE product_id='$product_id'";
                $result_product = mysqli_query($conn, $select_product);
                $product = mysqli_fetch_assoc($result_product);
                
                $product_name = $product["product_name"];
                $product_image = $product["product_image"];
                $price = $product["product_price"];
                $total += $price * $quantity;
                
                echo "
                    <tr>
                        <td class='align-middle'>$product_name</td>
                        <td>
                            <img src='./admin_area/$product_image' class='' alt=$product_name width='60' height='60'>
                        </td>
                        <td class='align-middle'>
                            <input class='text-center' type='number' name='quantity_$product_id' value='$quantity' min='0' style='width: 50px;'>
                        </td>
                        <td class='align-middle'>$total</td>
                        <td class='align-middle'>
                            <div class='form-check'>
                                <input class='form-check-input' type='checkbox' name='remove_item[]' value='$product_id'
                                >
                            </div>
                        </td>
                        <td class='align-middle'>
                            <button type='submit' name='update_cart' class='btn btn-danger'>Update</button>
                        </td>
                        <td class='align-middle'>
                            <button type='submit' name='remove_cart' class='btn btn-warning'>Remove</button>
                        </td>
                    </tr>
                    
                ";    
    
            }
        }else {
            echo "
                <tr>
                    <td class='align-middle text-danger' colspan='6'>No Have Product</td>
                </tr>
            ";
        }
        


    }

    function removeCartItem() {

        global $conn;

        if (isset($_POST['remove_cart'])) {
            if(isset($_POST['remove_item'])) {
                foreach($_POST['remove_item'] as $product_id ){
                    echo $product_id;
                    $sql = "DELETE FROM cart_details WHERE product_id=$product_id";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        echo "Item removed from cart";
                        echo "<script>window.open('cart.php', '_self')</script>";
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                }
            }
        }

    }

    function get_user_order_details() {
        global $conn;
        $username = $_SESSION['username'];
        $get_details = "SELECT * FROM user_table WHERE user_name = '$username'";
        $result_query = mysqli_query($conn, $get_details);

        while ($row = mysqli_fetch_assoc($result_query)) {
            $user_id = $row['user_id'];
            if(!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])) {

                $get_orders = "SELECT * FROM user_orders WHERE user_id = '$user_id' AND order_status = 'pending'";
                $result_orders_query = mysqli_query($conn, $get_orders);
                $row_count = mysqli_num_rows(($result_orders_query));

                if($row_count > 0) {
                    echo "<h3 class='text-center text-success'>You have <span class='text-danger'>$row_count</span> pending order</h3>";
                    echo "<p class='text-center'><a href='profile.php?my_orders'>Order Details</a></p>";
                }else {
                    echo "<h3 class='text-center'>You have zero pending order</h3>";
                    echo "<p class='text-center'><a href='../index.php'>Explore products</a></p>";
                }
            }
        }

    }
?>