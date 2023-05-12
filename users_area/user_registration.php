<?php
    // connect to database
    include '../includes/connectDB.php';

     // check if user click on submit button
     if(isset($_POST["submit"])) {

        // get value of the form
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
            $sql = "INSERT INTO products (product_name, product_price, product_description, category_id, brand_id, product_image, date, status) 
            VALUES ('$product_name', '$product_price', '$product_description', '$category_id', '$brand_id', '$image_path', NOW(), '$product_status')";


            if(mysqli_query($conn, $sql)) {
                echo "<script>alert('Product added successfully!')</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }

    
        // close connect
        mysqli_close($conn);

     }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product admin</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div class="container">

        <h2 class="text-center my-5">User Registration</h2>

        <div class="row">
            <form class="col-md-6 mx-auto" method="post" action="" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="user_name">User Name</label>
                    <input type="text" class="form-control" id="user_name" name="user_name"
                        placeholder="Enter User Name" required>
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="text" class="form-control" id="user_password" name="user_password"
                        placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="text" class="form-control" id="user_email" name="user_email"
                        placeholder="Enter Your Email" required>
                </div>
                <!-- add image -->
                <div class="form-group">
                    <label for="user_image">Image</label>
                    <input type="file" class="form-control-file" id="user_image" name="user_image" accept="image/*"
                        required>
                </div>
                <div class="form-group">
                    <label for="user_mobile">Mobile</label>
                    <input type="text" class="form-control" id="user_mobile" name="user_mobile"
                        placeholder="Enter Your Mobile" required>
                </div>
              
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

                <button type="submit" name="submit" class="btn btn-primary">Insert Product</button>
            </form>

        </div>
    </div>


    <?php
        // close connect
        mysqli_close($conn); 
    ?>


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