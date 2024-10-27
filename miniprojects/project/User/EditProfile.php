<?php
include("../Assets/Connection/connection.php");

session_start();
include('Head.php');
$user="select * from tbl_user where user_id=".$_SESSION['uid'];
$result=$con->query($user);
$data=$result->fetch_assoc();


  if(isset($_POST['txt_submit']))
  {
	
	 $insquery="update tbl_user set user_name='".$_POST['txtname']."',user_email='".$_POST['txtemail']."',user_address='".$_POST['txtaddress']."',user_contact='".$_POST['txtcontact']."' where user_id=".$_SESSION['uid'];
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
            <div class="text-center mb-4">
                <h2><strong>My Profile</strong></h2>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td><label for="txtname">Name</label></td>
                    <td><input type="text" class="form-control" name="txtname" id="txtname" value="<?php echo $data['user_name'];?>" /></td>
                </tr>
                <tr>
                    <td><label for="txtemail">Email</label></td>
                    <td><input type="email" class="form-control" name="txtemail" id="txtemail" value="<?php echo $data['user_email'];?>" /></td>
                </tr>
                <tr>
                    <td><label for="txtaddress">Address</label></td>
                    <td><input type="text" class="form-control" name="txtaddress" id="txtaddress" value="<?php echo $data['user_address'];?>" /></td>
                </tr>
                <tr>
                    <td><label for="txtcontact">Contact</label></td>
                    <td><input type="text" class="form-control" name="txtcontact" id="txtcontact" value="<?php echo $data['user_contact'];?>" /></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input type="submit" class="btn btn-primary" name="txt_submit" id="txt_submit" value="Submit" />
                    </td>
                </tr>
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