<h3 class="text-center text-success">All Product</h3>
<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">Product Id</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Image</th>
            <th scope="col">Product Price</th>
            <th scope="col">Total Sold</th>
            <th scope="col">Status</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>

    <?php
        // connect to database
        include_once '../includes/connectDB.php';
        include_once '../functions/common_function.php';

        $get_products = "SELECT * FROM products";
        $result_products = mysqli_query($conn, $get_products);

        while ($row = mysqli_fetch_assoc($result_products)) {

            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $product_image = $row['product_image'];
            $product_price = $row['product_price'];
            $status = $row['status'];

            $get_count = "SELECT * FROM orders_pending WHERE product_id = $product_id";
            $result = mysqli_query($conn, $get_count);
            $row_count = mysqli_num_rows(($result));

            echo "
                <tr>
                    <td>$product_id</td>
                    <td>$product_name</td>
                    <td>
                        <img src='$product_image' class='' alt=$product_name width='60' height='60'>
                    </td>
                    <td>$product_price</td>
                    <td>$row_count</td>
                    <td>$status</td>
                    <td><a href='?edit_products=$product_id'><i class='fas fa-edit'></i></a></td>
                    <td><a href='?delete_product=$product_id''><i class='fa-solid fa-trash'></i></a></td>
                </tr>
            ";

        }


    ?>
    </tbody>
</table>