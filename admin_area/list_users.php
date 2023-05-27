<h3 class="text-center text-success">List Users</h3>
<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">User Id</th>
            <th scope="col">User Name</th>
            <th scope="col">User Image</th>
            <th scope="col">User Email</th>
            <th scope="col">User Address</th>
            <th scope="col">User Mobile</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>

    <?php
        // connect to database
        include_once '../includes/connectDB.php';
        include_once '../functions/common_function.php';

        $get_users = "SELECT * FROM user_table";
        $result_users = mysqli_query($conn, $get_users);

        if(mysqli_num_rows($result_users) > 0) {
            
            while ($row = mysqli_fetch_assoc($result_users)) {
    
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_image = $row['user_image'];
                $user_email = $row['user_email'];
                $user_address = $row['user_address'];
                $user_mobile = $row['user_mobile'];
                
                echo "
                    <tr>
                        <td>$user_id</td>
                        <td>$user_name</td>
                        <td>
                            <img src='../users_area/$user_image' class='' alt=$user_image width='40' height='40'>
                        </td>
                        <td>$user_email</td>
                        <td>$user_address</td>
                        <td>$user_mobile</td>
                        <td>
                            <a href='?delete_payment=$user_id' type='button' data-toggle='modal' data-target='#exampleModal'>
                                <i class='fa-solid fa-trash'></i>
                            </a>
                        </td>
                    </tr>
                ";
    
            }

        }else {
            echo "
                <tr>
                    <td>No Payment yet</td>
                </tr>";
        }



    ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this User?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a type="button" href="?delete_category=<?php echo $category_id ?>" class="btn btn-primary">Yes</a>
      </div>
    </div>
  </div>
</div>