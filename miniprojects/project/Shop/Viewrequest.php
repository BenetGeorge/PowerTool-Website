 <?php
	  include('../Assets/Connection/connection.php');
	  session_start();
    include('Head.php');
      if(isset($_GET['acid']))
  {
	  $id=$_GET['acid'];
	  $delqry="update tbl_request set request_status='1' where request_id='".$id."'";
	  if($con->query($delqry))
	  {
		  ?>
		  <script>
		  alert('Accepted')
		  window.location="Viewrequest.php"
		  </script>
          <?php
	  }
  }
    if(isset($_GET['rid']))
  {
	  $id=$_GET['rid'];
  $delqry="update tbl_request set request_status='2' where request_id='".$id."'";
	  if($con->query($delqry))
	  {
		  ?>
		  <script>
		  alert('Rejected')
		  window.location="Viewrequest.php"
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
        <h3 class="text-center">User DETAILS</h3>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>USER NAME</th>
                        <th>CONTACT</th>
                        <th>RENT ITEM</th>
                        <th>FROM DATE</th>
                        <th>TO DATE</th>
                        <th>PRICE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selqry = "SELECT * FROM tbl_request r 
                                INNER JOIN tbl_rentitem re ON r.rent_id = re.rent_id 
                                INNER JOIN tbl_user u ON r.user_id = u.user_id 
                                WHERE re.shop_id = " . $_SESSION['sid'];
                    $i = 0;
                    $res = $con->query($selqry);
                    while ($data = $res->fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $data['user_name']; ?></td>
                        <td class="text-center"><?php echo $data['user_contact']; ?></td>
                        <td class="text-center"><?php echo $data['rent_name']; ?></td>
                        <td class="text-center"><?php echo $data['from_date']; ?></td>
                        <td class="text-center"><?php echo $data['to_date']; ?></td>
                        <td class="text-center"><?php echo $data['rent_price']; ?></td>
                        <td class="text-center">
                            <?php
                            if ($data['request_status'] == 0) {
                            ?>
                                <a href="Viewrequest.php?acid=<?php echo $data['request_id']; ?>" class="btn btn-success btn-sm">Accept</a>
                                <a href="Viewrequest.php?rid=<?php echo $data['request_id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                            <?php
                            } else if ($data['request_status'] == 1) {
                                echo "Request Approved";
                            } else if ($data['request_status'] == 2) {
                                echo "Request Rejected";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
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