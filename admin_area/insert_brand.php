<?php

    include '../includes/connectDB.php';



    // check if user click on submit button
    if(isset($_POST["submit"])){

        // get value of form by method post
        $brand_name = $_POST['brand_name'];

        // check if brand name existed
        $sql_check_is_exist_brand_name = "SELECT * FROM brands WHERE brand_name = '$brand_name'";
        $result_check = mysqli_query($conn, $sql_check_is_exist_brand_name);

        if (mysqli_num_rows($result_check) > 0) {
          echo "<script>alert('brand name already exists!')</script>";
          header('Refresh: 1; index.php');
        } else {
          // Insert new brand into database
          $sql = "INSERT INTO brands (brand_name) VALUES ('$brand_name')";
          $result = (mysqli_query($conn, $sql));
  
          if ($result) {
              echo "New brand created successfully";
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
      <h2 class="text-center">Insert New Brand</h2>
      <form action="#" method="post">
        <div class="form-group">
          <label for="brand_name">Brand Name</label>
          <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter brand name">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Insert Brand</button>
      </form>
    </div>
  </div>
</div>