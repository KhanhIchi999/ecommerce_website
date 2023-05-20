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

        $email = $row_userNamme['user_email'];
        $mobile = $row_userNamme['user_mobile'];
        $address = $row_userNamme['user_address'];
        $image = $row_userNamme['user_image'];
        $user_id = $row_userNamme['user_id'];

    }



    //  check if user click on submit button
     if(isset($_POST["submit"])) {

        // get value of the form
        $user_name = $_POST['user_name'];
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
        if($user_name == ''|| $user_email == '' 
         || $user_mobile == '') {
            echo "<script>alert('Please fill all the available fields!')</script>";
            exit();
        }else {

            $image_path = '';
    
            // Check if the image file is valid
            if(!empty($user_image_name)) {

                // Create a file path for the image
                $image_path = "user_images/" . $user_image_name;

                // Move the image file to the server
                move_uploaded_file($user_image_tmp, $image_path);
            }

            // check if user is exist by user_name
            $update_data = "UPDATE user_table SET user_name='$user_name', user_email='$user_email', user_image='$image_path', user_mobile='$user_mobile', user_address='$user_address' 
            WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $update_data);

            if($result) {
                echo "<script>alert('Successfully updated account!')</script>";
                echo "<script>window.open(user_logut.php', '_self')</script>";
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

<h1 class="text-center text-success">Edit Acount</h1>
<div class="row">
    <form class="col-md-6 mx-auto" method="post" action="" enctype="multipart/form-data">

        <div class="form-group">
            <label for="user_name">User Name</label>
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter User Name" 
                value=<?php echo $user_name?>
                required>
        </div>
        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter Your Email" 
                value=<?php echo $email?>
                required>
        </div>
        <!-- add image -->
        <div class="form-group d-flex">
            <input type="file" class="form-control" id="user_image" name="user_image" accept="image/*" required>
            <img src=<?php echo $user_image ?> alt="" class="edit_image">
        </div>
        <div class="form-group">
            <label for="user_mobile">Mobile</label>
            <input type="text" class="form-control" id="user_mobile" name="user_mobile" placeholder="Enter Your Mobile" 
                value=<?php echo $mobile?>
                required>
        </div>
        <div class="form-group">
            <label for="user_address">Address</label>
            <input type="text" class="form-control" id="user_address" name="user_address" placeholder="Enter Your Address" 
                value="<?php echo $address; ?>" 
                required>
        </div>
        <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary">Update Account</button>
        </div>
    </form>

</div>