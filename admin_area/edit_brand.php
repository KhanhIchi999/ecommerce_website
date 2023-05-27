<?php
    // connect to database
    include_once '../includes/connectDB.php';

    if(isset($_GET["edit_brand"])) {

        $brand_id = $_GET["edit_brand"];

        $get_brand = "SELECT * FROM brands WHERE brand_id = $brand_id";
        $result_brand = mysqli_query($conn, $get_brand);
        $row_brand = mysqli_fetch_assoc($result_brand);

        $brand_name = $row_brand['brand_name'];
        
        
    }

     // check if user click on submit button
     if(isset($_POST["submit"])) {

        // get value of the form
        $brand_id = $_POST['brand_id'];
        $brand_name = $_POST['brand_name'];
       

        //check valid if value is empty
        if($brand_name == '') {
            echo "<script>alert('Please fill all the available fields!')</script>";
            exit();
        }else {


            // Insert the product details into the database
            $sql = "UPDATE brands SET brand_name='$brand_name' WHERE brand_id ='$brand_id'";


            if(mysqli_query($conn, $sql)) {
                echo "<script>alert('Brand is updated successfully!')</script>";
                echo "<script>window.open('index.php?view_brands', '_self')</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }

    
        // close connect
        mysqli_close($conn);

     }
?>



<div class="container">

    <h3 class="text-center my-5">Edit Brand Id - </h3>

    <div class="row">
        <form class="col-md-6 mx-auto" method="post" action="edit_brand.php">

            <div class="form-group invisible">
                <label for="brand_id">Brand Id</label>
                <input type="text" class="form-control" id="brand_id" name="brand_id"
                    placeholder="Enter Brand id" value='<?php echo $brand_id?>' required>
            </div>
            <div class="form-group">
                <label for="brand_name">Brand Name</label>
                <input type="text" class="form-control" id="brand_name" name="brand_name"
                    placeholder="Enter Brand Name" value='<?php echo $brand_name?>' required>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary">Update Brand</button>
            </div>
        </form>

    </div>
</div>