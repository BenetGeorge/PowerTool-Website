6<?php

include('../Assets/Connection/connection.php');
include('Head.php');

  if(isset($_GET['acid']))
  {
	  $id=$_GET['acid'];
	  $delqry="update tbl_shop set shop_status='1' where shop_id='".$id."'";
	  if($con->query($delqry))
	  {
		  ?>
		  <script>
		  alert('Accepted')
		  window.location="ShopVerification.php"
		  </script>
          <?php
	  }
  }
  
   if(isset($_GET['rejid']))
  {
	  $id=$_GET['rejid'];
	  $delqry="update tbl_shop set shop_status='2' where shop_id='".$id."'";
	  if($con->query($delqry))
	  {
		  ?>
		  <script>
		  alert('Accepted')
		  window.location="ShopVerification.php"
		  </script>
          <?php
	  }
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AdminRegistration</title>
</head>


<body>

<!-- Navigation Link -->
<a href="HomePage.php" class="btn btn-primary m-3">Home</a>

<div class="container">

  <!-- New Shop List Section -->
  <h3 class="text-center mt-4">New Shop List</h3>
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>SINo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Photo</th>
        <th>Proof</th>
        <th>Place</th>
        <th>District</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $i = 0;
      $selquery = "select * from tbl_shop s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id where s.shop_status='0'";
      $result = $con->query($selquery);
      while($row = $result->fetch_assoc()) {
        $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row["shop_name"]; ?></td>
        <td><?php echo $row["shop_email"]; ?></td>
        <td><?php echo $row["shop_contact"]; ?></td>
        <td><?php echo $row["shop_address"]; ?></td>
        <td><img src="../Assets/Files/photo/<?php echo $row["shop_photo"]; ?>" width="80" height="80"></td>
        <td><img src="../Assets/Files/photo/<?php echo $row["shop_proof"]; ?>" width="80" height="80"></td>
        <td><?php echo $row["place_name"]; ?></td>
        <td><?php echo $row["district_name"]; ?></td>
        <td>
          <a href="ShopVerification.php?acid=<?php echo $row['shop_id']; ?>" class="btn btn-success btn-sm">Accept</a>
          <a href="ShopVerification.php?rejid=<?php echo $row['shop_id']; ?>" class="btn btn-danger btn-sm">Reject</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>

  <!-- Accepted Shop List Section -->
  <h3 class="text-center mt-4">Accepted List</h3>
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>SINo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Photo</th>
        <th>Proof</th>
        <th>Place</th>
        <th>District</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $i = 0;
      $selquery = "select * from tbl_shop s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id where s.shop_status='1'";
      $result = $con->query($selquery);
      while($row = $result->fetch_assoc()) {
        $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row["shop_name"]; ?></td>
        <td><?php echo $row["shop_email"]; ?></td>
        <td><?php echo $row["shop_contact"]; ?></td>
        <td><?php echo $row["shop_address"]; ?></td>
        <td><img src="../Assets/Files/photo/<?php echo $row["shop_photo"]; ?>" width="80" height="80"></td>
        <td><img src="../Assets/Files/photo/<?php echo $row["shop_proof"]; ?>" width="80" height="80"></td>
        <td><?php echo $row["place_name"]; ?></td>
        <td><?php echo $row["district_name"]; ?></td>
        <td>
          <a href="ShopVerification.php?rejid=<?php echo $row['shop_id']; ?>" class="btn btn-danger btn-sm">Reject</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>

  <!-- Rejected Shop List Section -->
  <h3 class="text-center mt-4">Rejected List</h3>
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>SINo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Photo</th>
        <th>Proof</th>
        <th>Place</th>
        <th>District</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $i = 0;
      $selquery = "select * from tbl_shop s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id where s.shop_status='2'";
      $result = $con->query($selquery);
      while($row = $result->fetch_assoc()) {
        $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row["shop_name"]; ?></td>
        <td><?php echo $row["shop_email"]; ?></td>
        <td><?php echo $row["shop_contact"]; ?></td>
        <td><?php echo $row["shop_address"]; ?></td>
        <td><img src="../Assets/Files/photo/<?php echo $row["shop_photo"]; ?>" width="80" height="80"></td>
        <td><img src="../Assets/Files/photo/<?php echo $row["shop_proof"]; ?>" width="80" height="80"></td>
        <td><?php echo $row["place_name"]; ?></td>
        <td><?php echo $row["district_name"]; ?></td>
        <td>
          <a href="ShopVerification.php?acid=<?php echo $row['shop_id']; ?>" class="btn btn-success btn-sm">Accept</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('Foot.php'); ?>