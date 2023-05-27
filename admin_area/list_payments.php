<h3 class="text-center text-success">All Payment</h3>
<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">Order Id</th>
            <th scope="col">Invoice number</th>
            <th scope="col">Amount</th>
            <th scope="col">Payment mode</th>
            <th scope="col">Order Date</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>

    <?php
        // connect to database
        include_once '../includes/connectDB.php';
        include_once '../functions/common_function.php';

        $get_orders = "SELECT * FROM user_payments";
        $result_orders = mysqli_query($conn, $get_orders);

        if(mysqli_num_rows($result_orders) > 0) {

            while ($row = mysqli_fetch_assoc($result_orders)) {
    
                $payment_id = $row['payment_id'];
                $invoice_number = $row['invoice_number'];
                $amount = $row['amount'];
                $payment_mode = $row['payment_mode'];
                $date = $row['date'];
                
                echo "
                    <tr>
                        <td>$payment_id </td>
                        <td>$invoice_number</td>
                        <td>$amount</td>
                        <td>$payment_mode</td>
                        <td>$date</td>
                        <td>
                            <a href='?delete_payment=$payment_id' type='button' data-toggle='modal' data-target='#exampleModal'>
                                <i class='fa-solid fa-trash'></i>
                            </a>
                        </td>
                    </tr>
                ";
    
            }

        }else {
            echo "
                <tr>
                    <td>No Payment yet</td>
                </tr>";
        }



    ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Payment?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a type="button" href="?delete_category=<?php echo $category_id ?>" class="btn btn-primary">Yes</a>
      </div>
    </div>
  </div>
</div>