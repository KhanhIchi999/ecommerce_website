
<h3 class="text-center text-success">All Order</h3>
<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">Order Id</th>
            <th scope="col">Due Amount</th>
            <th scope="col">Invoice number</th>
            <th scope="col">Total products</th>
            <th scope="col">Order Date</th>
            <th scope="col">Status</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
         <?php
            // connect to database
            include_once '../includes/connectDB.php';
            include_once '../functions/common_function.php';

            $get_orders = "SELECT * FROM user_orders";
            $result_orders = mysqli_query($conn, $get_orders);

            if(mysqli_num_rows($result_orders) > 0) {

                while ($row = mysqli_fetch_assoc($result_orders)) {
        
                    $order_id = $row['order_id'];
                    $amount_due = $row['amount_due'];
                    $invoice_number = $row['invoice_number'];
                    $total_products = $row['total_products'];
                    $order_date = $row['order_date'];
                    $order_status = $row['order_status'];
                    
        
        
                    echo "
                        <tr>
                            <td>$order_id </td>
                            <td>$amount_due</td>
                            <td>$invoice_number</td>
                            <td>$total_products</td>
                            <td>$order_date</td>
                            <td>$order_status</td>
                            <td>
                                <a href='?delete_=$order_id' type='button' data-toggle='modal' data-target='#exampleModal'>
                                    <i class='fa-solid fa-trash'></i>
                                </a>
                            </td>
                        </tr>
                    ";
        
                }

            }else {
                echo "
                    <tr>
                        <td>No orders yet</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this order?</h5>
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