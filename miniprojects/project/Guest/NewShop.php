                  
   <?php
  include('../Assets/Connection/connection.php');
  include('Head.php');
  if(isset($_POST['submit_btn']))
  {
     $name=$_POST['NAME_ID'];
     $email=$_POST['EMAIL_ID'];
     $contact=$_POST['CONTACT_ID'];
     $address=$_POST['ADDRESS_ID'];
     $password=$_POST['passowrd_id'];
     $place=$_POST['place_id'];
     $photo=$_FILES['photo_id']['name'];
     $temp=$_FILES['photo_id']['tmp_name'];
     move_uploaded_file($temp,'../Assets/Files/photo/'.$photo);
     $proof=$_FILES['proof_id']['name'];
     $temp1=$_FILES['proof_id']['tmp_name'];
     move_uploaded_file($temp1,'../Assets/Files/photo/'.$proof);
     $insquery="insert into tbl_shop(shop_name,shop_email,shop_contact,shop_address,shop_password ,shop_photo,place_id,shop_proof) 
                 values('".$name."','".$email."','".$contact."','".$address."','".$password."','".$photo."','".$place."','".$proof."')";
     if ($con->query($insquery))
     {
        ?>
        <script>
        alert("Data Inserted..")
        window.location="NewShop.php"
        </script>
        <?php
     }
  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<script>
    // Validate Email format
    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailPattern.test(email);
    }

    // Validate Phone number (only digits, 10 characters)
    function validatePhoneNumber(phone) {
        const phonePattern = /^[0-9]{10}$/;
        return phonePattern.test(phone);
    }

    // Validate Password (min 8 characters, 1 upper, 1 lower, 1 digit)
    function validatePassword(password) {
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        return passwordPattern.test(password);
    }

    // Function to validate the form
    function validateForm() {
        const email = document.getElementById('EMAIL_ID').value;
        const phone = document.getElementById('CONTACT_ID').value;
        const password = document.getElementById('passowrd_id').value;

        // Validate Email
        if (!validateEmail(email)) {
            alert("Please enter a valid email address.");
            return false;
        }

        // Validate Phone number
        if (!validatePhoneNumber(phone)) {
            alert("Please enter a valid 10-digit phone number.");
            return false;
        }

        // Validate Password
        if (!validatePassword(password)) {
            alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.");
            return false;
        }

        return true; // Form is valid
    }
</script>

</head>
<body>

<div class="container mt-5">
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validateForm()">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label for="NAME_ID" class="form-label">Name</label>
              <input type="text" class="form-control" name="NAME_ID" id="NAME_ID" required/>
            </div>

            <div class="mb-3">
              <label for="EMAIL_ID" class="form-label">Email</label>
              <input type="email" class="form-control" name="EMAIL_ID" id="EMAIL_ID" required/>
            </div>

            <div class="mb-3">
              <label for="CONTACT_ID" class="form-label">Contact</label>
              <input type="text" class="form-control" name="CONTACT_ID" id="CONTACT_ID" required/>
            </div>

            <div class="mb-3">
              <label for="ADDRESS_ID" class="form-label">Address</label>
              <input type="text" class="form-control" name="ADDRESS_ID" id="ADDRESS_ID" required/>
            </div>

            <div class="mb-3">
              <label for="DISTRICT_ID" class="form-label">District</label>
              <select class="form-select" name="DISTRICT_ID" id="DISTRICT_ID" onChange="getPlace(this.value)" required>
                <option value="">...select...</option>
                <?php 
                $sequery="select*from tbl_district";
                $res=$con->query($sequery);
                while($data=$res->fetch_assoc()) {
                ?>
                <option value="<?php echo $data['district_id']?>"><?php echo $data['district_name']?></option>
                <?php } ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="place_id" class="form-label">Place</label>
              <select class="form-select" name="place_id" id="place_id" required>
                <option>...select...</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="proof_id" class="form-label">Proof</label>
              <input type="file" class="form-control" name="proof_id" id="proof_id" required/>
            </div>

            <div class="mb-3">
              <label for="photo_id" class="form-label">Photo</label>
              <input type="file" class="form-control" name="photo_id" id="photo_id" required/>
            </div>

            <div class="mb-3">
              <label for="passowrd_id" class="form-label">Password</label>
              <input type="password" class="form-control" name="passowrd_id" id="passowrd_id" required/>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" name="submit_btn" id="submit_btn" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
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