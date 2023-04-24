<?php

    include '../includes/connectDB.php';



    // check if user click on submit button
    if(isset($_POST["submit"])){

        // get value of form by method post
        $category_name = $_POST['category_name'];

        // check if caterory name existed
        $sql_check_is_exist_category = "SELECT * FROM categories WHERE category_name = '$category_name'";
        $result_check = mysqli_query($conn, $sql_check_is_exist_category);

        if (mysqli_num_rows($result_check) > 0) {
          echo "<script>alert('Category name already exists!')</script>";
          header('Refresh: 1; index.php');
        } else {
          // Insert new category into database
          $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
          $result = (mysqli_query($conn, $sql));
  
          if ($result) {
              echo "New category created successfully";
              // header('Location: index.php?page=user');
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
            
        }

        
    }
    
    // close connect
    mysqli_close($conn);
    
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Insert New Category</h2>
            <form action="insert_category.php" method="post">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name"
                        placeholder="Enter category name">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Insert Category</button>
            </form>
        </div>
    </div>
</div>