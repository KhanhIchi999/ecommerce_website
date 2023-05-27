
<?php
    // connect to database
    include_once '../includes/connectDB.php';
    include_once '../functions/common_function.php';
    @session_start();

    if(isset($_SESSION['username'])) {
        
        $user_name = $_SESSION['username'];

        if(isset($_POST['delete'])) {
            
            echo "hello";
            $delete_query = "DELETE FROM user_table WHERE user_name='$user_name'";
            $result_delete_query = mysqli_query($conn, $delete_query);
    
            if($result_delete_query) {

                session_destroy();
                echo "<script>alert('Account is Deleted successfully!')</script>";
                echo "<script>window.open('../index.php', '_self')</script>";
            }else{
                echo "Error: " . $result_delete_query . "<br>" . mysqli_error($conn);
            }
        }
        
    }
    
    if(isset($_POST['dont_delete'])) {
        echo "<script>window.open('profile.php', '_self')</script>";
    }



?>
<div class="container">
    <h2 class="text-center text-danger">Delete Account</h2>
    <form action="" method="POST">
        <input type="submit" class="form-control w-50 mx-auto my-4" value="Delete Account" name="delete">
        <input type="submit" class="form-control w-50 mx-auto my-2" value="Don't Delete Account" name="dont_delete">
    </form>

</div>