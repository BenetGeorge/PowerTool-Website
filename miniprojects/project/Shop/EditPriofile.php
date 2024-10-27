<?php
include("../Assets/Connection/connection.php");

session_start();
include('Head.php');
$user="select * from tbl_shop where shop_id=".$_SESSION['uid'];
$result=$con->query($user);
$data=$result->fetch_assoc();


  if(isset($_POST['txt_submit']))
  {
	
	 $insquery="update tbl_shop set shop_name='".$_POST['txtname']."',shop_email='".$_POST['txtemail']."',shop_address='".$_POST['txtaddress']."',shop_contact='".$_POST['txtcontact']."' where shop_id=".$_SESSION['uid'];
	 if ($con->query($insquery));
	 {
		?>
        <script>
		alert("ProfileUpdated...")
		window.location="MyProfile.php"
		</script>
        <?php
		 
		 
		 
	 }
	 //echo $district;
  }
  
  
  
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
    <div class="container mt-5">
        <form id="form1" name="form1" method="post" action="">
            <div class="card">
                <div class="card-header text-center">
                    <h5>My Profile</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="txtname" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="txtname" id="txtname" class="form-control" value="<?php echo $data['shop_name']; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtemail" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="txtemail" id="txtemail" class="form-control" value="<?php echo $data['shop_email']; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtaddress" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <input type="text" name="txtaddress" id="txtaddress" class="form-control" value="<?php echo $data['shop_address']; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtcontact" class="col-sm-4 col-form-label">Contact</label>
                        <div class="col-sm-8">
                            <input type="text" name="txtcontact" id="txtcontact" class="form-control" value="<?php echo $data['shop_contact']; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row text-center">
                        <div class="col-sm-12">
                            <input type="submit" name="txt_submit" id="txt_submit" value="Submit" class="btn btn-primary" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('Foot.php');?>