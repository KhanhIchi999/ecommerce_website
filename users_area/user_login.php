<?php
    @session_start();
    // connect to database
    include '../includes/connectDB.php';

     // check if user click on submit button
     if(isset($_POST["submit"])) {

        // get value of the form
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        

        $sql = "SELECT * FROM `user_table` WHERE `user_name` = '$user_name'";
        $result = mysqli_query($conn, $sql);

        if($result) {

            $row_count = mysqli_num_rows($result);
            $row_data = mysqli_fetch_assoc($result);

            if($row_count > 0){

               if(password_verify($user_password, $row_data['user_password'])){
                    $_SESSION['username'] = $user_name;
                    echo "<script>alert('Login successfully!')</script>";
                    echo "<script>window.open('checkout.php', '_self')</script>";
               }else {
                    echo "<script>alert('Invalid password!')</script>";
               }
            }else{
                echo "<script>window.open('../index.php', '_self')</script>";
            }

        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // close connect
        mysqli_close($conn);

     }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div class="container">

        <h2 class="text-center my-5">Login</h2>

        <div class="row">
            <form class="col-md-6 mx-auto" method="post" action="">

                <div class="form-group">
                    <label for="user_name">User Name</label>
                    <input type="text" class="form-control" id="user_name" name="user_name"
                        placeholder="Enter User Name" required>
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="text" class="form-control" id="user_password" name="user_password"
                        placeholder="Enter Password" required>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

        </div>
        <div>
            <p class="text-center p-4">Don't have an account ? <a href="user_registration.php">Register</a></p>
        </div>

    </div>


    <?php
        // close connect
        // mysqli_close($conn); 
    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>