
<?php 

    $ip = getIPAddress();

    // select all data from the user_table table where ip_address matches the user's IP
    $sql = "SELECT * FROM user_table WHERE user_ip='$ip'";
    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    } else {
        if (mysqli_num_rows($result) > 0) {
            // IP address exists in the user_table
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['user_id'];
            }
        } else {
            // IP address not found in the user_table
            echo "IP address not found.";
        }
    }
  
?>



<div class="container">
    <h2 class="text-center">Payment options</h2>
    <div class="row">
        <div class="col-md-6">
            <a href="https://www.google.com.vn/?hl=vi" target="_blank">
                <img src="../images/paypal.png" alt="">
            </a>
        </div>
        <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id?>">Pay offline</a>
        </div>
    </div>
</div>