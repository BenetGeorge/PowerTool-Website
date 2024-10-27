<?php
include('../Assets/Connection/connection.php');

session_start();
include('Head.php');

if (isset($_GET['rid'])) {
    $requestId = $_GET['rid'];

    // Fetch the rental details
    $selDate = "SELECT 
                    DATEDIFF(CURDATE(), STR_TO_DATE(from_date, '%Y-%m-%d')) AS date_difference, 
                    rent_price 
                FROM tbl_request 
                INNER JOIN tbl_rentitem ON tbl_request.rent_id = tbl_rentitem.rent_id 
                WHERE request_id = $requestId";

    $date = $con->query($selDate);
    if ($date && $data = $date->fetch_assoc()) {
        $days = $data['date_difference'] > 0 ? $data['date_difference'] : 0; 
        $totalRent = ($days-1) * $data['rent_price'];

        echo "$days days used<br>";
        echo "Total Rent (for $days days): " . $totalRent . "<br>";

        // Update the total rent in the database
        $updateTotalRent = "UPDATE tbl_request SET request_amount = $totalRent, request_status = 3 WHERE request_id = $requestId"; // Assuming request_status=3 means item return requested
        $con->query($updateTotalRent);

        echo "Return Requested";
    } else {
        echo "Error fetching rental details.";
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>User Request Viewing</title>
</head>
<body>
    <div class="container mt-5">
        <form id="form1" name="form1" method="post" action="">
        <table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th>SL NO</th>
            <th>SELLER NAME</th>
            <th>CONTACT</th>
            <th>RENT ITEM</th>
            <th>FROM DATE</th>
            <th>TO DATE</th>
            <th>PRICE</th>
            <th>DAYS</th>
            <th>TOTAL</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $selqry = "SELECT * FROM tbl_request r 
                    INNER JOIN tbl_rentitem re ON r.rent_id = re.rent_id 
                    INNER JOIN tbl_shop s ON re.shop_id = s.shop_id  
                    WHERE r.user_id = " . $_SESSION['uid'];
        $i = 0;
        $res = $con->query($selqry);
        while ($data = $res->fetch_assoc()) {
            $i++;

            // Initialize variables
            $days = 0;
            $totalAmount = 0.00;

            // If request_status = 4 (item returned), calculate days and amount from from_date to to_date
            if ($data['request_status'] == 4) {
                $fromDate = new DateTime($data['from_date']);
                $toDate = new DateTime($data['to_date']);
                
                // Calculate the difference in days
                $interval = $fromDate->diff($toDate);
                $days = $interval->days; // Get the total number of days

                // Calculate total amount (price per day * number of days)
                $pricePerDay = floatval($data['rent_price']);
                $totalAmount = ($days-1) * $pricePerDay;
            } 
            // If request_status != 4 (item not returned), calculate days and amount from from_date to current date
            else {
                $fromDate = new DateTime($data['from_date']);
                $currentDate = new DateTime(); // Get current date
                // Calculate the difference in days
                $interval = $fromDate->diff($currentDate);
                $days = $interval->days; // Get the total number of days

                // Calculate total amount (price per day * number of days)
                $pricePerDay = floatval($data['rent_price']);
                $totalAmount = ($days-1) * $pricePerDay;
            }
            ?>
            <tr>
                <td class="text-center"><?php echo $i ?></td>
                <td class="text-center"><?php echo $data['shop_name'] ?></td>
                <td class="text-center"><?php echo $data['shop_contact'] ?></td>
                <td class="text-center"><?php echo $data['rent_name'] ?></td>
                <td class="text-center"><?php echo $data['from_date'] ?></td>
                <td class="text-center"><?php echo $data['to_date'] ?></td>
                <td class="text-center"><?php echo $data['rent_price'] ?></td>

                <!-- Display number of days rented and total price -->
                <td class="text-center"><?php echo $days ?></td>
                <td class="text-center"><?php echo number_format($totalAmount, 2) ?></td>

                <td class="text-center">
                    <!-- Action buttons if needed -->
                    <?php
                                if ($data['request_status'] == 0) {
                                    echo "Request Pending...";
                                } elseif ($data['request_status'] == 1 && $data['payment_status']==0) {
                                    echo "Request Approved";
                                    // if($data['payment_status']==0){
                                        echo "Pay Advance Amount:" . $data['rent_price'];
                                    ?>
                                    <a href="Payment.php?aid=<?php echo $data['request_id'] ?>&amt=<?php $data['rent_price'] ?>" class="btn btn-link">Payment</a>
                                    <?php
                                    // }
                            }
                                else if($data['request_status'] == 1 && $data['payment_status']==1){
                                    ?>
                                        <a href="MyRequest.php?rid=<?php echo $data['request_id'] ?>" class="btn btn-link">Return</a>
                                        <?php
                                }
                                elseif ($data['request_status'] == 2) {
                                    echo "Request Rejected";
                                } elseif ($data['request_status'] == 4) {
                                    echo "Completed";
                                } elseif ($data['request_status'] == 3) {
                                    echo "Return Requested. Amount: " . $data['request_amount'];
                                    ?>
                                    <a href="Payment.php?pid=<?php echo $data['request_id'] ?>" class="btn btn-link">Payment</a>
                                    <?php
                                }
                                ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>



        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('Foot.php');?>
