<?php

session_start();
include('../Assets/Connection/connection.php');
include('Head.php');

$message="";
if(isset($_POST['btnUpdate']))
{
	$current=$_POST['txtcurrent'];
	$newpwd=$_POST['txtnew'];
	$confirm=$_POST['txtconfirm'];

    $selQry="select * from tbl_user where user_password='".$current."' and user_id = '".$_SESSION['uid']."'";
	$resUser=$con->query($selQry);

	if($datauser=$resUser->fetch_assoc())
	{
		if($newpwd==$confirm)
		{
			 $upQry="update tbl_user set user_password='".$_POST['txtconfirm']."' where user_id=".$_SESSION['uid'];
	 		 if ($con->query($upQry))
			 {
				 $message="PasswordChanged...";
			 }
		}
		else
		{
				$message="Password not Equal";
		}
	}
	else
	{
			$message="Please check Old Password...";
	}
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
  <h3 class="text-center">Update Password</h3>
  <form id="form1" name="form1" method="post" action="">
    <table class="table table-bordered mt-4">
      <tr>
        <td>Current Password</td>
        <td><input type="password" name="txtcurrent" id="txtcurrent" class="form-control" required /></td>
      </tr>
      <tr>
        <td>New Password</td>
        <td><input type="password" name="txtnew" id="txtnew" class="form-control" required /></td>
      </tr>
      <tr>
        <td>Confirm Password</td>
        <td><input type="password" name="txtconfirm" id="txtconfirm" class="form-control" required /></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <button type="submit" name="btnUpdate" id="btnUpdate" class="btn btn-primary">Update</button>
          <button type="reset" name="btnCancel" id="btnCancel" class="btn btn-secondary">Cancel</button>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <?php if(isset($message)) echo $message; ?>
        </td>
      </tr>
    </table>
  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php include('Foot.php'); ?>