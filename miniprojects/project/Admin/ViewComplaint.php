<?php

session_start();
include('../Assets/Connection/connection.php');
include('Head.php');

  if(isset($_GET['did']))
  {
	 $_SESSION["cid"]=$_GET['did'];
	 header("location:ComplaintReply.php");
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ViewComplaint</title>
</head>


<body>

<!-- Navigation Link -->
<a href="HomePage.php" class="btn btn-primary m-3">Home</a>

<div class="container">

  <!-- New Complaints Section -->
  <h3 class="text-center mt-4">New Complaints</h3>
  <table class="table table-bordered table-striped mt-3">
    <thead class="thead-dark">
      <tr>
        <th scope="col">SINo</th>
        <th scope="col">Title</th>
        <th scope="col">Complaint</th>
        <th scope="col">User</th>
        <th scope="col">Email</th>
        <th scope="col">Contact</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $i = 0;
      $selquery = "select * from tbl_complaint c inner join tbl_user u on  c.user_id=u.user_id where complaint_status='0'";
      $result = $con->query($selquery);
      while($row = $result->fetch_assoc()) {
        $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['complaint_title']; ?></td>
        <td><?php echo $row['complaint_content']; ?></td>
        <td><?php echo $row['user_name']; ?></td>
        <td><?php echo $row['user_email']; ?></td>
        <td><?php echo $row['user_contact']; ?></td>
        <td><a href="ViewComplaint.php?did=<?php echo $row['complaint_id']; ?>" class="btn btn-primary btn-sm">Reply</a></td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>

  <!-- Solved Complaints Section -->
  <h3 class="text-center mt-5">Solved Complaints</h3>
  <table class="table table-bordered table-striped mt-3">
    <thead class="thead-dark">
      <tr>
        <th scope="col">SINo</th>
        <th scope="col">Title</th>
        <th scope="col">Complaint</th>
        <th scope="col">User</th>
        <th scope="col">Email</th>
        <th scope="col">Contact</th>
        <th scope="col">Reply</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $i = 0;
      $selquery = "select * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id where complaint_status='1'";
      $result = $con->query($selquery);
      while($row = $result->fetch_assoc()) {
        $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['complaint_title']; ?></td>
        <td><?php echo $row['complaint_content']; ?></td>
        <td><?php echo $row['user_name']; ?></td>
        <td><?php echo $row['user_email']; ?></td>
        <td><?php echo $row['user_contact']; ?></td>
        <td><?php echo $row['complaint_reply']; ?></td>
      </tr>
    <?php
      }
    ?>
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