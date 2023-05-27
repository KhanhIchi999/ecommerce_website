<h3 class="text-center text-success">View Brand</h3>
<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">Brand Id</th>
            <th scope="col">Brand Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>

    <?php
        // connect to database
        include_once '../includes/connectDB.php';
        include_once '../functions/common_function.php';

        $get_brands = "SELECT * FROM brands";
        $result_brands = mysqli_query($conn, $get_brands);

        while ($row = mysqli_fetch_assoc($result_brands)) {

            $brand_id = $row['brand_id'];
            $brand_name = $row['brand_name'];
            


            echo "
                <tr>
                    <td>$brand_id </td>
                    <td>$brand_name</td>
                    <td><a href='?edit_brand=$brand_id '><i class='fas fa-edit'></i></a></td>
                    <td>
                        <a href='?delete_brand=$brand_id' type='button' data-toggle='modal' data-target='#exampleModal'>
                            <i class='fa-solid fa-trash'></i>
                        </a>
                    </td>
                </tr>
            ";

        }


    ?>
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this brand?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a type="button" href="?delete_brand=<?php echo $brand_id ?>" class="btn btn-primary">Yes</a>
      </div>
    </div>
  </div>
</div>