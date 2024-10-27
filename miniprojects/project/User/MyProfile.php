<?php

session_start();
include("../assets/connection/connection.php");
include('Head.php');

// Fetch user details along with their profile image
$user = "SELECT * FROM tbl_user u 
         INNER JOIN tbl_place p ON u.place_id = p.place_id 
         INNER JOIN tbl_district d ON d.district_id = p.district_id 
         WHERE user_id = '".$_SESSION['uid']."'";
         
$result = $con->query($user);
$data = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>My Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>

<form id="form1" name="form1" method="post" action="">
    <div class="container mt-5">
        <h3 class="text-center">My Profile</h3>
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <!-- Display user image -->
                    <img src="../Assets/Files/photo/<?php echo $data['user_photo']; ?>" alt="User Image" class="profile-image img-fluid">
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td><?php echo $data['user_name'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><?php echo $data['user_email'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Contact</strong></td>
                            <td><?php echo $data['user_contact'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td><?php echo $data['user_address'];?></td>
                        </tr>
                        <tr>
                            <td><strong>District</strong></td>
                            <td><?php echo $data['district_name'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Place</strong></td>
                            <td><?php echo $data['place_name'];?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a href="EditProfile.php" class="btn btn-primary">Edit Profile</a>
                                <a href="ChangePassword.php" class="btn btn-secondary">Change Password</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php include('Foot.php'); ?>
