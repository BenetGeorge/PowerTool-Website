<?php
include('../Assets/Connection/connection.php');
include('Head.php');
if (isset($_POST['submit_btn'])) {
    $name = $_POST['NAME_ID'];
    $email = $_POST['EMAIL_ID'];
    $contact = $_POST['CONTACT_ID'];
    $address = $_POST['ADDRESS_ID'];
    $password = $_POST['passowrd_id'];
    $place = $_POST['place_id'];
    $photo = $_FILES['photo_id']['name'];
    $temp = $_FILES['photo_id']['tmp_name'];
    move_uploaded_file($temp, '../Assets/Files/photo/' . $photo);
    $insquery = "INSERT INTO tbl_user(user_name, user_email, user_contact, user_address, user_password, user_photo, place_id) 
                 VALUES('" . $name . "','" . $email . "','" . $contact . "','" . $address . "','" . $password . "','" . $photo . "','" . $place . "')";
    if ($con->query($insquery)) {
        ?>
        <script>
            alert("Data Inserted..");
            window.location = "NewUser.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>

    <script>
        // Function to validate email format
        function validateEmail(email) {
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return emailPattern.test(email);
        }

        // Function to validate phone number format (10 digits)
        function validatePhoneNumber(phone) {
            const phonePattern = /^[0-9]{10}$/; // Assuming 10-digit phone number
            return phonePattern.test(phone);
        }

        // Function to validate password (min 8 characters, 1 upper, 1 lower, 1 digit)
        function validatePassword(password) {
            const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            return passwordPattern.test(password);
        }

        // Function to validate the form on submit
        function validateForm() {
            const email = document.getElementById('EMAIL_ID').value;
            const phone = document.getElementById('CONTACT_ID').value;
            const password = document.getElementById('passowrd_id').value;

            // Validate email
            if (!validateEmail(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Validate phone number
            if (!validatePhoneNumber(phone)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }

            // Validate password
            if (!validatePassword(password)) {
                alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.");
                return false;
            }

            // If all validations pass
            return true;
        }
    </script>
</head>

<body>

<div class="container mt-5">
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validateForm()">
        <table class="table table-bordered table-striped">
            <tr>
                <td>Name</td>
                <td><input type="text" class="form-control" name="NAME_ID" id="NAME_ID" required/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" class="form-control" name="EMAIL_ID" id="EMAIL_ID" required/></td>
            </tr>
            <tr>
                <td>Contact</td>
                <td><input type="text" class="form-control" name="CONTACT_ID" id="CONTACT_ID" required/></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input type="text" class="form-control" name="ADDRESS_ID" id="ADDRESS_ID" required/></td>
            </tr>
            <tr>
                <td>District</td>
                <td>
                    <select class="form-select" name="DISTRICT_ID" id="DISTRICT_ID" onChange="getPlace(this.value)" required>
                        <option value="">...select...</option>
                        <?php
                        $sequery = "SELECT * FROM tbl_district";
                        $res = $con->query($sequery);
                        while ($data = $res->fetch_assoc()) { ?>
                            <option value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Place</td>
                <td>
                    <select class="form-select" name="place_id" id="place_id" required>
                        <option>...select...</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Photo</td>
                <td><input type="file" class="form-control" name="photo_id" id="photo_id" required/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" class="form-control" name="passowrd_id" id="passowrd_id" required/></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="text-center">
                        <button type="submit" name="submit_btn" id="submit_btn" class="btn btn-primary">Submit</button>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>

<!-- Bootstrap JS (Optional for Bootstrap's JS features) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getPlace(did) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
            success: function (result) {
                $("#place_id").html(result);
            }
        });
    }
</script>
<?php include('Foot.php'); ?>