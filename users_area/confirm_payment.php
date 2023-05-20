<?php
    // connect to database
     include_once '../includes/connectDB.php';
     include_once '../functions/common_function.php';

     session_start();

     if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
        
        $get_order_details = "SELECT * FROM user_orders WHERE order_id ='$order_id'";
        $result_order_details = mysqli_query($conn, $get_order_details);
        $row_order_details = mysqli_fetch_assoc($result_order_details);
        $amount_due = $row_order_details['amount_due'];
        $invoice_number = $row_order_details['invoice_number'];

     }

     if(isset($_POST['submit'])){
        $invoice_number = $_POST['invoice_number'];
        $amount_due = $_POST['amount'];
        $payment_mode = $_POST['payment_mode'];

        $sql = "INSERT INTO user_payments (order_id, invoice_number, amount, payment_mode, date) 
                VALUES ('$order_id', '$invoice_number', '$amount_due', '$payment_mode', NOW())";

        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>alert('Confirm is submitted successfully!')</script>";
            $update_orders = "UPDATE user_orders SET order_status='Complete' WHERE order_id = '$order_id'";
            $result_orders = mysqli_query($conn, $update_orders);

            if($result_orders) {
                echo "<script>window.open('Profile.php?my_orders', '_self')</script>";
            }
            
        }else{
            echo "Error: " . $result . "<br>" . mysqli_error($conn);
        }
        
     }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="bg-dark">
    <div class="container text-center text-white">
        <h1 class="p-5">Confirm Payment</h1>
        <div class="row">
            <form class="col-md-6 mx-auto" method="post" action="">
                <div class="form-group">
                    <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                         value=<?php echo $invoice_number ?>>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount"
                        value=<?php echo $amount_due ?> required>
                </div>
                <div class="form-group">
                    <select class="form-control" id="payment_mode" name="payment_mode" required>
                        <option value="">Select Payment Mode</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
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