
<?php
    // connect to database
    include_once '../includes/connectDB.php';
    include_once '../functions/common_function.php';
    @session_start();



    if(isset($_GET['delete_product'])) {
        $product_id = $_GET['delete_product'];
    }
    
    if(isset($_POST['delete'])) {

        $product_id = $_POST['product_id'];
        
        $delete_query = "DELETE FROM products WHERE product_id='$product_id'";
        $result_delete_query = mysqli_query($conn, $delete_query);

        if($result_delete_query) {

            echo "<script>alert('Product is Deleted successfully!')</script>";
            echo "<script>window.open('index.php?view_products', '_self')</script>";
        }else{
            echo "Error: " . $result_delete_query . "<br>" . mysqli_error($conn);
        }
    }

    if(isset($_POST['dont_delete'])) {
        echo "<script>window.open('index.php?view_products', '_self')</script>";
    }



?>
<div class="container">
    <h2 class="text-center text-danger">Delete Product Id = <?php echo $product_id ?></h2>
    <form action="" method="POST">
        <input type="text" class="invisible" value=<?php echo $product_id?> name="product_id">
        <input type="submit" class="form-control w-50 mx-auto my-4" value="Delete Product" name="delete">
        <input type="submit" class="form-control w-50 mx-auto my-2" value="Don't Delete Product" name="dont_delete">
    </form>

</div>