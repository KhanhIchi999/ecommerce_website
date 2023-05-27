<?php
    // connect to database
    include_once '../includes/connectDB.php';

    if(isset($_GET["edit_products"])) {

        $product_id = $_GET["edit_products"];
        $get_product = "SELECT * FROM products WHERE product_id = $product_id";
        $result_product = mysqli_query($conn, $get_product);
        $row_product = mysqli_fetch_assoc($result_product);

        $product_name = $row_product['product_name'];
        $product_image = $row_product['product_image'];
        $product_price = (float)$row_product['product_price'];
        $product_description = $row_product['product_description'];
        $status = $row_product['status'];
        $category_id = $row_product['category_id'];
        $brand_id = $row_product['brand_id'];
        
    }

     // check if user click on submit button
     if(isset($_POST["submit"])) {

        // get value of the form
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_description = $_POST['product_description'];
        $category_id = $_POST['category_id'];
        $brand_id = $_POST['brand_id'];
        $product_status = "true";

        // handle upload image
        // Get the image file details
        $product_image_name = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];
        $product_image_size = $_FILES['product_image']['size'];
        $product_image_type = $_FILES['product_image']['type'];

        //check valid if value is empty
        if($product_name == '' || $product_price == '' || $product_description == '' 
         || $category_id == '' || $brand_id == '' || $product_image_name == '') {
            echo "<script>alert('Please fill all the available fields!')</script>";
            exit();
        }else {

            // Check if the image file is valid
            if(!empty($product_image_name)) {

                // Create a file path for the image
                $image_path = "product_images/" . $product_image_name;

                // Move the image file to the server
                move_uploaded_file($product_image_tmp, $image_path);
            }

            // Insert the product details into the database
            $sql = "UPDATE products SET product_name='$product_name', product_price='$product_price', product_description='$product_description'
            , category_id='$category_id', brand_id='$brand_id', product_image='$image_path', date=NOW() WHERE product_id='$product_id'";


            if(mysqli_query($conn, $sql)) {
                echo "<script>alert('Product is updated successfully!)</script>";
                echo "<script>window.open(view_products.php', '_self')</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }

    
        // close connect
        mysqli_close($conn);

     }
?>

<style>
    .edit_image {
        width: 50px;
        height: 50px;
        object-fit: cover; 
    }
</style>


<div class="container">

    <h3 class="text-center my-5">Edit Product</h3>

    <div class="row">
        <form class="col-md-6 mx-auto" method="post" action="edit_products.php" enctype="multipart/form-data">

            <div class="form-group invisible">
                <label for="product_id">Product Id</label>
                <input type="text" class="form-control" id="product_id" name="product_id"
                    placeholder="Enter Product Name" value='<?php echo $product_id?>' required>
            </div>
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    placeholder="Enter Product Name" value='<?php echo $product_name?>' required>
            </div>
            <div class="form-group">
                <label for="product_price">Price</label>
                <input type="number" class="form-control" id="product_price" name="product_price" 
                    value='<?php echo $product_price?>'required>
            </div>

            <!-- add image -->
            <label for="product_image">Product Image</label>
            <div class="form-group d-flex">
                <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*"
                    required>
                <img src=<?php echo $product_image ?> alt="" class="edit_image">
            </div>

            <div class="form-group">
                <label for="product_description">Product Description</label>
                <textarea class="form-control" id="product_description" name="product_description"
                    placeholder="Enter Product Description" rows="3" required><?php echo $product_description?></textarea>
            </div>

            <!-- select categories -->
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option selected disabled>Select Category</option>
                    <?php
                
                    // get all categories
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $sql);

                    // loop through categories and create options
                    while($row = mysqli_fetch_assoc($result)) {
                        $category_id = $row['category_id'];
                        $category_name = $row['category_name'];
                        echo "<option value='$category_id'>$category_name</option>";
                    }
                ?>
                </select>
            </div>

            <!-- select brands -->
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select class="form-control" id="brand_id" name="brand_id" required>
                    <option selected disabled>Select Brand</option>
                    <?php
                
                    include '../includes/connectDB.php';
                    // get all brands
                    $sql = "SELECT * FROM brands";
                    $result = mysqli_query($conn, $sql);

                    // loop through brands and create options 
                    while($row = mysqli_fetch_assoc($result)) {
                        $brand_id = $row['brand_id'];
                        $brand_name = $row['brand_name'];
                        echo "<option value='$brand_id'>$brand_name</option>";
                    }
                ?>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary">Update Product</button>
            </div>
        </form>

    </div>
</div>