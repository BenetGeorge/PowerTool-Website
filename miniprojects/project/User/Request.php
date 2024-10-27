
<?php
  include('../Assets/Connection/connection.php');
  
  session_start();
  include('Head.php');
  if(isset($_POST['btn_submit']))
  {
	 $from=$_POST['txt_fromdate'];
	 $to=$_POST['txt_todate'];
	 $rentid=$_GET['rid'];
	
	 $insquery="insert into tbl_request(from_date,to_date,user_id,rent_id) values('".$from."','".$to."','".$_SESSION['uid']."','". $rentid."')";
	 if ($con->query($insquery))
	 {
		?>
        <script>
		alert("data Inserted..")
		window.location="MyRequest.php"
		</script>
        <?php
		 
  
	 }
  }
   
  ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center">Select Date Range</h3>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered">
                <tr>
                    <td width="150">FROM DATE</td>
                    <td width="150">
                        <input type="date" name="txt_fromdate" id="txt_fromdate" min="<?php echo Date('Y-m-d') ?>" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td>TO DATE</td>
                    <td>
                        <input type="date" name="txt_todate" id="txt_todate" min="<?php echo Date('Y-m-d') ?>" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="text-center">
                            <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Submit" />
                        </div>
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