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
        $totalRent = $days * $data['rent_price'];

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
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i ?></td>
                            <td class="text-center"><?php echo $data['shop_name'] ?></td>
                            <td class="text-center"><?php echo $data['shop_contact'] ?></td>
                            <td class="text-center"><?php echo $data['rent_name'] ?></td>
                            <td class="text-center"><?php echo $data['from_date'] ?></td>
                            <td class="text-center"><?php echo $data['to_date'] ?></td>
                            <td class="text-center"><?php echo $data['rent_price'] ?></td>
                            <td class="text-center">
                                <?php
                                if ($data['request_status'] == 0) {
                                    echo "Request Pending...";
                                } elseif ($data['request_status'] == 1) {
                                    echo "Request Approved";
                                    // Display return link if amount is not set
                                    if (empty($data['request_amount'])) {
                                        ?>
                                        <a href="MyRequest.php?rid=<?php echo $data['request_id'] ?>" class="btn btn-link">Return</a>
                                        <?php
                                    } else {
                                        // Show return amount and payment option
                                        echo " Returned Amount: " . $data['request_amount'] . " ";
                                        echo '<a href="Payment.php" class="btn btn-link">Payment</a>';
                                    }
                                } elseif ($data['request_status'] == 2) {
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
