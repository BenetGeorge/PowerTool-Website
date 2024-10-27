<?php	
include('../Assets/Connection/Connection.php');
session_start();
$query = "SELECT * FROM `tbl_request` 
          WHERE STR_TO_DATE(`to_date`, '%Y-%m-%d') < CURDATE() and request_status<4 and user_id=".$_SESSION['uid'];
$result = $con->query($query);

$overdueRequests = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $overdueRequests[] = $row;
    }
}

// Send data as JSON to the frontend
echo json_encode($overdueRequests);
?>
