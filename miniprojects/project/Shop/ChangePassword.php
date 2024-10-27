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

    $selQry="select * from tbl_shop where shop_password='".$current."' and shop_id = '".$_SESSION['uid']."'";
	$resUser=$con->query($selQry);

	if($datauser=$resUser->fetch_assoc())
	{
		if($newpwd==$confirm)
		{
			 $upQry="update tbl_shop set shop_password='".$_POST['txtconfirm']."' where shop_id=".$_SESSION['uid'];
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
        <form id="form1" name="form1" method="post" action="">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Change Password</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="txtcurrent" class="col-sm-4 col-form-label">Current Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="txtcurrent" id="txtcurrent" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtnew" class="col-sm-4 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="txtnew" id="txtnew" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtconfirm" class="col-sm-4 col-form-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="txtconfirm" id="txtconfirm" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group row text-center">
                        <div class="col-sm-12">
                            <input type="submit" name="btnUpdate" id="btnUpdate" value="Update" class="btn btn-primary" />
                            <input type="reset" name="btnCancel" id="btnCancel" value="Cancel" class="btn btn-secondary" />
                        </div>
                    </div>
                    <div class="form-group row text-center">
                        <div class="col-sm-12">
                            <span><?php echo $message; ?></span>
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