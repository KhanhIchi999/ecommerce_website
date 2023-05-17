<?php
    // connect to database
    include '../includes/connectDB.php';
    include '../functions/common_function.php';

     // check if user click on submit button
     if(isset($_POST["submit"])) {

        // get value of the form
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
        $user_email = $_POST['user_email'];
        $user_mobile = $_POST['user_mobile'];
        $user_address = $_POST['user_address'];
        $user_ip = getIPAddress();

        // handle upload image
        // Get the image file details
        $user_image_name = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $user_image_size = $_FILES['user_image']['size'];
        $user_image_type = $_FILES['user_image']['type'];

        //check valid if value is empty
        if($user_name == '' || $user_password == '' || $user_email == '' 
         || $user_mobile == '') {
            echo "<script>alert('Please fill all the available fields!')</script>";
            exit();
        }else {

            // check if user is exist by user_name
            $queryName = "SELECT * FROM user_table WHERE user_name='$user_name'";
            $result = mysqli_query($conn, $queryName);
            $rows_count = mysqli_num_rows($result);

            if($rows_count > 0) {
                echo "<script>alert('Username already exist!')</script>";
            }else{
                $image_path = '';
    
                // Check if the image file is valid
                if(!empty($user_image_name)) {
    
                    // Create a file path for the image
                    $image_path = "user_images/" . $user_image_name;
    
                    // Move the image file to the server
                    move_uploaded_file($user_image_tmp, $image_path);
                }
    
                // Insert the product details into the database
                $sql = "INSERT INTO user_table (user_name, user_email, user_password, user_image, user_mobile, 	user_ip, user_address) 
                VALUES ('$user_name', '$user_email', '$hash_password', '$image_path', '$user_mobile', '$user_ip', '$user_address ')";
    
    
                if(mysqli_query($conn, $sql)) {

                    echo "<script>alert('Register successfully!')</script>";

                    $select_cart_items = "SELECT * FROM `cart_details` WHERE `ip_address` = '$user_ip'";
                    $result_cart = mysqli_query($conn, $select_cart_items);
                    $rows_count_cart = mysqli_num_rows($result_cart);

                    if($rows_count_cart > 0){
                        echo "<script>alert('You have items in your cart!')</script>";
                        echo "<script>window.open('checkout.php', '_self')</script>";
                    }else{
                        echo "<script>window.open('../index.php', '_self')</script>";
                    }

                } else {
                    echo "Error: " . mysqli_error($conn);
                }
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
    <title>User Registration</title>

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
                    <input type="email" class="form-control" id="user_email" name="user_email"
                        placeholder="Enter Your Email" required>
                </div>
                <div class="form-group">
                    <label for="user_mobile">Mobile</label>
                    <input type="text" class="form-control" id="user_mobile" name="user_mobile"
                        placeholder="Enter Your Mobile" required>
                </div>
                <div class="form-group">
                    <label for="user_address">Address</label>
                    <input type="text" class="form-control" id="user_address" name="user_address"
                        placeholder="Enter Your Adress" required>
                </div>
                <!-- add image -->
                <div class="form-group">
                    <label for="user_image">Image</label>
                    <input type="file" class="form-control-file" id="user_image" name="user_image" accept="image/*"
                        required>
                </div>
              
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Registration</button>
                </div>
            </form>

        </div>
        <div>
            <p class="text-center p-4">Already have an account ? <a href="user_login.php">Login</a></p>
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