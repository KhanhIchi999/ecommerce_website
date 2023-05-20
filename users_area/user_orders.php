<?php
    // connect to database
    include_once '../includes/connectDB.php';
    include_once '../functions/common_function.php';
    @session_start();

    if(isset($_SESSION['username'])) {
        
        $user_name = $_SESSION['username'];

        $queryName = "SELECT * FROM user_table WHERE user_name='$user_name'";
        $result_queryName = mysqli_query($conn, $queryName);

        $row_userNamme = mysqli_fetch_assoc($result_queryName);
        $user_id = $row_userNamme['user_id'];

    }




?>

<h2 class="text-center text-success">All My Orders</h2>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Amount Due</th>
                <th>Total Products</th>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php 

                $get_order_details = "SELECT * FROM user_orders WHERE user_id ='$user_id'";
                $result_order_details = mysqli_query($conn, $get_order_details);
                $number = 0;
                while($row_order_details = mysqli_fetch_assoc($result_order_details)) {
                    $order_id = $row_order_details['order_id'];
                    $amount_due = $row_order_details['amount_due'];
                    $total_products = $row_order_details['total_products'];
                    $invoice_number = $row_order_details['invoice_number'];
                    $order_date = $row_order_details['order_date'];
                    $order_status = $row_order_details['order_status'];

                    if($order_status == 'pending') {
                        $order_status = 'Incomplete';
                    }

                    $number++;
                    echo "
                            <tr>
                                <td>$number</td>
                                <td>$amount_due</td>
                                <td>$total_products</td>
                                <td>$invoice_number</td>
                                <td>$order_date</td>
                                <td>$order_status</td>";
                        if ($order_status == 'Complete') {
                            echo "<td>Paid</td>";
                        } else {
                            echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>";
                        }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>