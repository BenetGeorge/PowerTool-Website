<?php

session_start();
include("../assets/connection/connection.php");
include('Head.php');

$user = "SELECT * FROM tbl_shop u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id WHERE shop_id = '".$_SESSION['sid']."'";
$result=$con->query($user);
$data=$result->fetch_assoc();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center">My Profile</h3>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td><?php echo $data['shop_name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><?php echo $data['shop_email']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Contact</strong></td>
                            <td><?php echo $data['shop_contact']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td><?php echo $data['shop_address']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>District</strong></td>
                            <td><?php echo $data['district_name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Place</strong></td>
                            <td><?php echo $data['place_name']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="EditProfile.php" class="btn btn-warning">Edit Profile</a>
                    <a href="ChangePassword.php" class="btn btn-info">Change Password</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('Foot.php');?>