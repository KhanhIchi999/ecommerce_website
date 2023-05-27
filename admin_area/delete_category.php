<?php
    // connect to database
    include_once '../includes/connectDB.php';

    if(isset($_GET["delete_category"])) {
        $category_id = $_GET["delete_category"];
        $delete_query = "DELETE FROM categories WHERE category_id='$category_id'";
        $result_delete_query = mysqli_query($conn, $delete_query);

        if($result_delete_query) {

            echo "<script>alert('Category is deleted successfully!')</script>";
            echo "<script>window.open('index.php?view_categories', '_self')</script>";
        }else{
            echo "Error: " . $result_delete_query . "<br>" . mysqli_error($conn);
        }       
    }

    // close connect
    mysqli_close($conn);

    
?>

