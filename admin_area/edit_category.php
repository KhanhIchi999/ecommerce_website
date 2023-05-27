<?php
    // connect to database
    include_once '../includes/connectDB.php';

    if(isset($_GET["edit_category"])) {

        $category_id = $_GET["edit_category"];

        $get_category = "SELECT * FROM categories WHERE category_id = $category_id";
        $result_category = mysqli_query($conn, $get_category);
        $row_category = mysqli_fetch_assoc($result_category);

        $category_name = $row_category['category_name'];
        
        
    }

    // check if user click on submit button
    if(isset($_POST["submit"])) {

    // get value of the form
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    

    //check valid if value is empty
    if($category_name == '') {
        echo "<script>alert('Please fill all the available fields!')</script>";
        exit();
    }else {
        
        // Insert the product details into the database
        $sql = "UPDATE categories SET category_name='$category_name' WHERE category_id='$category_id'";
        
        if(mysqli_query($conn, $sql)) {
            echo "<script>alert('Category is updated successfully!')</script>";
            echo "<script>window.open('index.php?view_categories', '_self')</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }


    // close connect
    mysqli_close($conn);

    }
?>



<div class="container">

    <h3 class="text-center my-5">Edit Category Id - <?php echo $category_id?></h3>

    <div class="row">
        <form class="col-md-6 mx-auto" method="post" action="edit_category.php">

            <div class="form-group invisible">
                <label for="category_id">Category Id</label>
                <input type="text" class="form-control" id="category_id" name="category_id"
                    placeholder="Enter Category id" value='<?php echo $category_id?>' required>
            </div>
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name"
                    placeholder="Enter Category Name" value='<?php echo $category_name?>' required>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary">Update Category</button>
            </div>
        </form>

    </div>
</div>