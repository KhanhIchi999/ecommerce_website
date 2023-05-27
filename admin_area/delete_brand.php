<?php
    // connect to database
    include_once '../includes/connectDB.php';

    if(isset($_GET["delete_brand"])) {
        $brand_id = $_GET["delete_brand"]; 
        $delete_query = "DELETE FROM brands WHERE brand_id='$brand_id'";
        $result_delete_query = mysqli_query($conn, $delete_query);

        if($result_delete_query) {

            echo "<script>alert('Brand is deleted successfully!')</script>";
            echo "<script>window.open('index.php?view_brands', '_self')</script>";
        }else{
            echo "Error: " . $result_delete_query . "<br>" . mysqli_error($conn);
        }      
    }


    // close connect
    mysqli_close($conn);

    
?>
