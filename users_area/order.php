<?php
    session_start();
    // connect to database
    include_once '../includes/connectDB.php';
    include_once '../functions/common_function.php';

    if(isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    }

    $ip = getIPAddress();

    // get cart detail by ip
    $sql = "SELECT * FROM cart_details WHERE ip_address='$ip'";
    $result = mysqli_query($conn, $sql);
    $count_products = mysqli_num_rows($result);


    if ($result === false) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    } else {

        // random invoice_number
        $invoice_number = mt_rand();
        $status='pending';
        $total_price = 0;

        if ($count_products > 0) {

            // IP address exists in the user_table
            while ($row = mysqli_fetch_assoc($result)) {

                // get product_id from cart_details
                $product_id = $row['product_id'];
                $product_quantity = $row['quantity'];

                // get all product_price from product by product_id+
                $select_product = "SELECT * FROM products WHERE product_id='$product_id'";
                $result_product = mysqli_query($conn, $select_product);
                $row_price = mysqli_fetch_assoc($result_product);
                $product_price = (float)$row_price['product_price'];
                $total_price += $product_price * (float)$product_quantity;

                 // insert orders_pending table
                $insert_pending_orders = "INSERT INTO orders_pending (user_id, invoice_number, product_id, quantity, order_status) 
                VALUES ($user_id, $product_price, $product_id, $product_quantity, '$status')";

                $result_pending_orders = mysqli_query($conn, $insert_pending_orders);

                if(!$result_pending_orders){
                    echo "Error: " . $result_pending_orders . "<br>" . mysqli_error($conn);
                }
                
            }

            // insert usert_orders table
            $insert_orders = "INSERT INTO user_orders (user_id, amount_due, invoice_number, order_date, order_status, total_products) 
            VALUES ($user_id, $total_price, $invoice_number, NOW(), '$status', $count_products)";

            $result_query = mysqli_query($conn, $insert_orders);

            if($result_query){
                echo "<script>alert('Orders are submitted successfully!')</script>";
                echo "<script>window.open('Profile.php', '_self')</script>";
            }else{
                echo "Error: " . $result_query . "<br>" . mysqli_error($conn);
            }

            // delete items from cart
            $empty_cart = "DELETE FROM cart_details WHERE ip_address='$ip'";
            $result_empty_cart = mysqli_query($conn, $empty_cart);

            if(!$result_empty_cart){
                echo "Error: " . $result_empty_cart . "<br>" . mysqli_error($conn);
            }


        } else {
            // IP address not found in the user_table
            echo "No items in carts.";
        }
    }
  

?>